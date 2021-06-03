<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserUpdate;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Services\UserService;
use Validator;
use Auth;
use DB;
class UserController extends Controller
{
   
 
 
    protected $userservice;

    public function __construct(UserService $userservice)
    {
        $this->authorizeResource(User::class, 'user');
        $this->userservice = $userservice;
    }

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
    public function show(User $user)
    {
         try {  
              return response()->json([
                 "success" => true,
                 "message" => "User Retrieve Successfully.",
                 "data" => new UserResource($user)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdate $request,User $user)
    {
        try {  

            $data = $request->validated();
            $user = $this->userservice->update($request, $user->id);
            return response()->json([
                 "success" => true,
                 "message" => "Updated Successfully.",
              ]);
        } catch (\Exception $e) {
           
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
    public function destroy(User $user)
    {
        
        try {  
            $this->userservice->delete($user->id);
            
            return response()->json([
                 "success" => true,
                 "message" => "Deleted Successfully.",
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