<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserUpdate;
use App\Http\Resources\UserResrource;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
class UserController extends Controller
{
   
 
 
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        \DB::beginTransaction();
         try {  
             if(empty($id)){
                return response()->json([
                    "success" => false,
                    "message" => "ID is required."
                ]); 
             }
             $user = User::find($id);
             if(empty($user)){
                return response()->json([
                    "success" => false,
                    "message" => "User does not exists."
                ]); 
             }
              return response()->json([
                 "success" => true,
                 "message" => "User Retrieve Successfully.",
                 "data" => new UserResrource($user)
              ]);
                 
        } catch (\Exception $e) {
            \DB::rollback();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdate $request, $id)
    {
        \DB::beginTransaction();
        try {  
            $params = $request->validated();
            $user = User::find($id);
            if(empty($user)){
                return response()->json([
                    "success" => false,
                    "message" => "User does not exists."
                ]); 
            }
            $data = $request->all();
            $user = User::where('id',$id)->update($data);
             \DB::commit();
            return response()->json([
                 "success" => true,
                 "message" => "Updated Successfully.",
                 "data" => new UserResrource($user)
              ]);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json([
             "success" => false,
             "message" => "Server Error.",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {  
            $user = User::find($id);
            if(empty($user)){
                return response()->json([
                    "success" => false,
                    "message" => "User does not exists."
                ]); 
            }
            $user->delete();
            \DB::commit();
            return response()->json([
                 "success" => true,
                 "message" => "Deleted Successfully.",
              ]);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json([
             "success" => false,
             "message" => "Server Error.",
            ]);
        }
    }
}
?>