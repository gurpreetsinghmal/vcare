<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ApiController extends Controller
{
    public function getuser(Request $request)
    {

        if ($request["access_token"]) {

            $token = trim($request["access_token"]);
            $user = User::where('access_token', $token)
            ->select(
                'id', 'name', 'mobile','role_id','district_id','block_id','village_id',)->first();
            if ($user) {
                // You can return a Blade view with user information
                $data =[];
                $data["id"]=$user->id;
                $data["name"]=$user->name;
                $data["mobile"]=$user->mobile;
                $data["role"]=$user->role->description;
                $data["district"]=$user->district->name;
                $data["block"]=$user->block->name;
                $data["village"]=$user->village->name;
                $data["photo"]=$user->profile_photo_url;
                return response()->json($data);
            } else {
                // Handle user not found
                $data = array("code" => 404, "msg" => "No User Found");
            }
        } else {
            $data = array("code" => 999, "msg" => "Invalid Request");
        }
        return response()->json($data);
    }

    public function updatetoken(Request $request)
    {
        
        if ($request["mobile"] && $request["access_token"]) {
            $mobileNumber = $request["mobile"];
            $mobileNumber = trim($mobileNumber);
            $user = User::where('mobile', $mobileNumber)->first();
            
            if ($user) {
                $user->access_token = trim($request["access_token"]);
                $user->save();
                return response()->json(["code" => 200, "msg" => "New Device Registered"]);
            } 
            else {
                // Handle user not found
                $data = array("code" => 404, "msg" => "No User Found");
            }
        } else {
            $data = array("code" => 999, "msg" => "Invalid Request");
        }
        return response()->json($data);
    }

   public function getuserbymobile(Request $request){
        if ($request["mobile"]){
            
            $mob = trim($request["mobile"]);
            $user = User::where('mobile', $mob)->first();
            if ($user){
                $data = array("code" => 200, "msg" => "User Found");
            }else{
                $data = array("code" => 404, "msg" => "No User Found");
            }
            
            
           
        }
        else
        {
             $data = array("code" => 500, "msg" => "Invalid Request");
        }
         return response()->json($data);
        
    }
}
