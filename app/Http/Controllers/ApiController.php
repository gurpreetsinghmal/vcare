<?php

namespace App\Http\Controllers;

use App\Models\DBVMappings;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Village;


class ApiController extends Controller
{
    public function getuser(Request $request)
    {

        if ($request["access_token"]) {

            $token = trim($request["access_token"]);
            $user = User::where('access_token', $token)
                ->select(
                    'id',
                    'name',
                    'mobile',
                    'role_id',
                    'district_id',
                    'block_id',
                    'village_id',
                )->first();
            if ($user) {
                // You can return a Blade view with user information
                $data = [];
                $data["id"] = $user->id;
                $data["name"] = $user->name;
                $data["mobile"] = $user->mobile;
                $data["role"] = $user->role->description;
                $data["district"] = $user->district->name;
                $data["dist_code"] = $user->district_id;
                $data["block"] = $user->block->name;
                $data["block_code"] = $user->block_id;
                $data["village"] = $user->village->name;
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
            $u->user_id = $asha->id;
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
        $district = $request["district"];
        $block = $request["block"];
        $vill = [];
        $user = DBVMappings::where('district_id', $district)->where('block_id', $block)->get();
        foreach ($user as $r) {
            $vill[$r->village_id] = $r->village->name;
        }
        return response()->json($user);
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

            if ($request["rchid"]) {
                $rch = trim($request["rchid"]);
                $user = Patient::where('rchid', $rch)->first();
            }

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
