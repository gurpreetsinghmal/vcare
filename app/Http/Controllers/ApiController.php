<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ApiController extends Controller
{
    public function getuser(Request $request){
    
        if($request["access_token"])
        {
            $mobile=$request["access_token"];
            $mobile=substr($mobile,4);
            $u=User::where("mobile","=",$mobile)->get();
            $data=$u;
            dd($u);
        }
        else{
            $data=array("code"=>999,"msg"=>"No user Found");
        }
        return response()->json($data); 
    }
}
