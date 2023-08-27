<?php

namespace App\Http\Controllers;

use App\Models\AllUserMapping;
use App\Models\DBVMappings;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Village;


class ApiController extends Controller
{
    public function getAshaProfile(Request $request)
    {

        if ($request["access_token"]) {

            $token = trim($request["access_token"]);
            $user = User::where('access_token', $token)
                ->select(
                    'id',
                    'name',
                    'mobile',
                    'role_id',
                )->first();
            if ($user && $user->role_id==1) {
                // You can return a Blade view with user information
                $map=AllUserMapping::where('asha_id',$user->id)->get();
               
                $data = [];
                $data["id"] = $user->id;
                $data["name"] = $user->name;
                $data["mobile"] = $user->mobile;
                $data["role"] = $user->role->description;
                $data["district"] = $map->first()->district->name??"NA";
                $data["dist_code"] = $map->first()->district->id??"NA";
                $data["block"] = $map->first()->block->name??"NA";
                $data["block_code"] = $map->first()->block->id??"NA";
                $v=[];
                foreach ($map as $l) {
                    if($l->village)
                    $v[$l->village->id]=$l->village->name;
                }
                $data["villages"] =$v;
                $data["anm"]=$map->first()->anm->name??"NA";
                $data["photo"] = $user->profile_photo_url;
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

    public function getAnmProfile(Request $request)
    {

        if ($request["access_token"]) {

            $token = trim($request["access_token"]);
            $user = User::where('access_token', $token)
                ->select(
                    'id',
                    'name',
                    'mobile',
                    'role_id',
                )->first();
            if ($user && $user->role_id==2) {
                // You can return a Blade view with user information
                $map=AllUserMapping::where('anm_id',$user->id)->get();
                
                $data = [];
                $data["id"] = $user->id;
                $data["name"] = $user->name;
                $data["mobile"] = $user->mobile;
                $data["role"] = $user->role->description;
                $data["district"] = $map->first()->district->name??"NA";
                $data["dist_code"] = $map->first()->district->id??"NA";
                $data["block"] = $map->first()->block->name??"NA";
                $data["block_code"] = $map->first()->block->id??"NA";
                $v=[];
                foreach ($map as $l) {
                    if($l->asha)
                    $v[$l->asha->id]=$l->asha->name;
                }
                $data["ashas"] =$v;
                $data["smo"]=$map->first()->smo->name??"NA";
                $data["photo"] = $user->profile_photo_url;
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

    public function addpatient(Request $request)
    {
        if ($request["access_token"]) {
            $u = new Patient();
            $u->name = $request["name"];
            $u->husbandName = $request["husbandName"];
            $u->village_id = $request["village"];
            $u->mobile = $request["mobile"];
            $u->currDeliveryCount = $request["currDeliveryCount"];
            $u->prevChildAge = $request["prevChildAge"];
            $u->previousDeliveryType = $request["previousDeliveryType"];
            $u->sexPreviousChild = $request["sexPreviousChild"];
            $u->tt1Switch = $request["tt1switch"];
            $u->tt2Switch = $request["tt2switch"];
            $u->ttbswitch = $request["ttbswitch"];
            $u->counsDiet = $request["counsDiet"];
            $asha = User::where('access_token', $request["access_token"])->first();
            $u->asha_id = $asha->id;
            if ($u->save()) {
                return response()->json(["code" => 200, "msg" => "New Record Saved"]);
            } else {
                // Handle user not found
                $data = array("code" => 404, "msg" => "No User Found");
            }
        } else {
            $data = array("code" => 999, "msg" => "Invalid Request");
        }
        return response()->json($data);
    }

    public function anmupdatepatient(Request $request){
        if ($request["access_token"]) {
            $u = Patient::find($request["id"]);
            $data=$request;
        }else {
            $data = array("code" => 999, "msg" => "Invalid Request");
        }
        return response()->json($data);
    }

    public function updatepatient(Request $request)
    {
        if ($request["access_token"]) {
            $u = Patient::find($request["id"]);
            if($request["tt1switch"])
            $u->tt1Switch = $request["tt1switch"];

            if($request["tt2switch"])
            $u->tt2Switch = $request["tt2switch"];
            if($request["ttbswitch"])
            $u->ttbswitch = $request["ttbswitch"];
            if($request["counsDiet"])
            $u->counsDiet = $request["counsDiet"];

            $asha = User::where('access_token', $request["access_token"])->first();
            $u->user_id = $asha->id;
            if ($u->save()) {
                return response()->json(["code" => 200, "msg" => "Record Updated"]);
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
            } else {
                // Handle user not found
                $data = array("code" => 404, "msg" => "No User Found");
            }
        } else {
            $data = array("code" => 999, "msg" => "Invalid Request");
        }
        return response()->json($data);
    }

    public function getuserbymobile(Request $request)
    {
        if ($request["mobile"]) {

            $mob = trim($request["mobile"]);
            $user = User::where('mobile', $mob)->first();
            if ($user) {
                $data = array("code" => 200, "msg" => "User Found");
            } else {
                $data = array("code" => 404, "msg" => "No User Found");
            }
        } else {
            $data = array("code" => 500, "msg" => "Invalid Request");
        }
        return response()->json($data);
    }

    public function getvillagelist(Request $request)
    {
        if ($request["access_token"]) {
            $token = trim($request["access_token"]);
            $user = User::where('access_token', $token)->select('id')->first();
            if ($user) {
                $list=AllUserMapping::where('asha_id',$user->id)->get();
                $v=[];
               
                foreach ($list as $l) {
                    if($l->village)
                    $v[]=$l->village->name;
                }
                
                return response()->json(["code" => 200, "msg" => $v]);
            } else {
                // Handle user not found
                $data = array("code" => 404, "msg" => "No User Found");
            }
    } else {
        $data = array("code" => 999, "msg" => "Invalid Request");
    }
    return response()->json($data);
    }

    public function searchPatient(Request $request)
    {
        if ($request["mobile"] || $request["rchid"]) {

            if ($request["mobile"]) {
                $mob = trim($request["mobile"]);
                $user = Patient::where('mobile', $mob)->get();
                $vill=[];
                foreach($user as $r){
                    $vill[$r->village_id]=$r->village->name;
                    
                }
            }

            // if ($request["rchid"]) {
            //     $rch = trim($request["rchid"]);
            //     $user = Patient::where('rchid', $rch)->first();
            // }

            if (count($user)) {
                $data = array("code" => 200, "msg" => "User Found", "patient" => $user);
            } else {
                $data = array("code" => 404, "msg" => "No User Found");
            }
        } else {
            $data = array("code" => 500, "msg" => "Invalid Request");
        }
        return response()->json($data);
    }
}
