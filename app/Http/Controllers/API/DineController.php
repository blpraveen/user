<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;
use App\Events\DishMail;
use Illuminate\Http\Request;
use Event;
use Validator;
use Auth;
use DB;
use Carbon\Carbon;
class DineController extends Controller
{
   
 
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function creatOrder(Request $request)
    {
     \DB::beginTransaction();
    //try {	
     $input = $request->all();
     $validator = Validator::make($input, [
     'dish_id' => 'required',
     'sub_total' => 'required',
     'tax' => 'nullable',
     'discount' => 'nullable',
     'total' => 'required',
     'quantity' => 'required',
     ]);
 
     if($validator->fails()){
     return response()->json([
     "success" => false,
     "message" => "Validation Error.",
     "errors" => $validator->errors()
     ]);      
     }
     $dish = Dish::find($input['dish_id']);
     if(empty($dish)){
        return response()->json([
        "success" => false,
        "message" => "Dish does not exists."
     ]); 
     }
     if($dish['quantity'] < $input['quantity']){
        Event::dispatch(new DishMail($input['dish_id']));
     }

    $input['user_id'] = Auth::guard('api')->user()->id;
     $order = Order::create($input);
     $dish->available = $dish->available - $input['quantity'];
     $dish->save();
     \DB::commit();
     return response()->json([
     "success" => true,
     "message" => "Order created successfully.",
     "data" => $order
     ]);
     /*} catch (\Exception $e) {
      \DB::rollback();
       return response()->json([
     "success" => false,
     "message" => "Server Error.",
     ]);
    }*/
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function aggregate()
    {
    try {
         $orders = Order::selectRaw('sum(dish_id) as sold_count,dish_id')->where('created_at','>=','( CURDATE() - INTERVAL 2 DAY )')->groupBy('dish_id')->with('dish')->get();
         return response()->json([
         "success" => true,
         "message" => "Orders retrieved successfully.",
         "data" => $orders
         ]);
    } catch (\Exception $e) {
       return response()->json([
     "success" => false,
     "message" => "Server Error.",
     ]);
    }
    }
 
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function sold()
    {
    
    try {
        $orders_most_sold = Order::selectRaw('sum(dish_id) as sold_count,dish_id')->where('created_at','>=','( CURDATE() - INTERVAL 10 DAY )')->orderBy('sold_count','desc')->groupBy('dish_id')->with('dish')->take(5)->get();
        $orders_least_sold = Order::selectRaw('sum(dish_id) as sold_count,dish_id')->where('created_at','>=','( CURDATE() - INTERVAL 10 DAY )')->orderBy('sold_count','asc')->groupBy('dish_id')->with('dish')->take(5)->get();
     return response()->json([
         "success" => true,
         "message" => "Orders retrieved successfully.",
         "data" => ['order_most_sold' => $orders_most_sold,'order_least_sold' => $orders_least_sold]
         ]);
    } catch (\Exception $e) {
       return response()->json([
     "success" => false,
     "message" => "Server Error.",
     ]);
    }
    }
 
}
?>