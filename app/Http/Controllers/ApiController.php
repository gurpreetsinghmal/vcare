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
            $user = User::where('access_token', $token)->first();
            if ($user) {
                // You can return a Blade view with user information
                $data = $user;
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
            $mobileNumber = $request->input("mobile");
            $mobileNumber = trim(substr($mobileNumber, 2));
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
}
