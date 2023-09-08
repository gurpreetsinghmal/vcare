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
                $v=DBVMappings::where('village_id',$map[0]->village_id)->first();
                $data["dist_name"] = $v->district->name??"NA";
                $data["dist_code"] = $v->district_id??"NA";
                $data["block_name"] = $v->block->name??"NA";
                $data["block_code"] = $v->block_id??"NA";
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
                $v=DBVMappings::where('village_id',$map[0]->village_id)->first();
                $data["dist_name"] = $v->district->name??"NA";
                $data["dist_code"] = $v->district_id??"NA";
                $data["block_name"] = $v->block->name??"NA";
                $data["block_code"] = $v->block_id??"NA";
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
        $token = trim($request["access_token"]);
        $anm = User::where('access_token', $token)
                ->select(
                    'id',
                    'name',
                    'mobile',
                    'role_id',
                )->first();
        if ($anm && $anm->role_id==2) {
            
           $u = Patient::find($request["id"]);
           if($u){
        //   $u->name = $request["name"];
        //   $u->husbandName = $request["husbandName"];
        //   $u->village_id = $request["village"];
        //   $u->mobile = $request["mobile"];
        //   $u->currDeliveryCount = $request["currDeliveryCount"];
        //   $u->prevChildAge = $request["prevChildAge"];
        //   $u->previousDeliveryType = $request["previousDeliveryType"];
        //   $u->sexPreviousChild = $request["sexPreviousChild"];
        //   $u->tt1Switch = $request["tt1switch"];
        //   $u->tt2Switch = $request["tt2switch"];
        //   $u->ttbswitch = $request["ttbswitch"];
        //   $u->counsDiet = $request["counsDiet"];
           $u->anm_id= $request["anm_id"];
           $u->gdmo_id=$request["gdmo_id"];
           $u->gyno_id=$request["gyno_id"];
           $u->doctor_id=$request["doctor_id"];
           $u->rchid=$request["rchid"];
           $u->mothername=$request["mothername"];
           $u->ageatmarriage=$request["ageatmarriage"];
           $u->dob=$request["dob"];
           $u->bankname=$request["bankname"];
           $u->accountno=$request["accountno"];
           $u->ifsccode=$request["ifsccode"];
           $u->caste=$request["caste"];
           $u->economy=$request["economy"];
           $u->address=$request["address"];
           $u->Lmp=$request["Lmp"];
           $u->edd=$request["edd"];
           $u->weight=$request["weight"];
           $u->height=$request["height"];
           $u->pastillness=$request["pastillness"];
           $u->JSYBeneficiary=$request["JSYBeneficiary"];
           $u->badhistory=$request["badhistory"];
           $u->siteofdelivery=$request["siteofdelivery"];
           $u->anc1_date=$request["anc1_date"];
           $u->anc1_weekofpregnancy=$request["anc1_weekofpregnancy"];
           $u->anc1_bpSystolic=$request["anc1_bpSystolic"];
           $u->anc1_bpDiastolic=$request["anc1_bpDiastolic"];
           $u->anc1_fundalheight=$request["anc1_fundalheight"];
           $u->anc1_bloodsugarfasting=$request["anc1_bloodsugarfasting"];
           $u->anc1_bloodsugarpost=$request["anc1_bloodsugarpost"];
           $u->anc1_highrisk=$request["anc1_highrisk"];
           $u->anc1_hblevel=$request["anc1_hblevel"];
           $u->anc1_urinesugar=$request["anc1_urinesugar"];
           $u->anc1_urinealbumin=$request["anc1_urinealbumin"];
           $u->anc1_folictabcount=$request["anc1_folictabcount"];
           $u->anc1_folicdate=$request["anc1_folicdate"];
           $u->anc1_ifatabcount=$request["anc1_ifatabcount"];
           $u->anc1_ifadate=$request["anc1_ifadate"];
           $u->anc1_counselling=$request["anc1_counselling"];
           $u->anc2_date=$request["anc2_date"];
           $u->anc2_bp=$request["anc2_bp"];
           $u->anc2_bloodsugar=$request["anc2_bloodsugar"];
           $u->anc2_highrisk=$request["anc2_highrisk"];
           $u->anc2_hblevel=$request["anc2_hblevel"];
           $u->anc2_fundalheight=$request["anc2_fundalheight"];
           $u->anc2_Foetalheartrate=$request["anc2_Foetalheartrate"];
           $u->anc2_FoetalMovements=$request["anc2_FoetalMovements"];
           $u->anc2_usg=$request["anc2_usg"];
           $u->anc3_date=$request["anc3_date"];
           $u->anc3_bp=$request["anc3_bp"];
           $u->anc3_bloodsugar=$request["anc3_bloodsugar"];
           $u->anc3_highrisk=$request["anc3_highrisk"];
           $u->anc3_hblevel=$request["anc3_hblevel"];
           $u->anc3_fundalheight=$request["anc3_fundalheight"];
           $u->anc3_Foetalheartrate=$request["anc3_Foetalheartrate"];
           $u->anc3_FoetalMovements=$request["anc3_FoetalMovements"];
           $u->anc3_usg=$request["anc3_usg"];
           $u->anc4_date=$request["anc4_date"];
           $u->anc4_bp=$request["anc4_bp"];
           $u->anc4_bloodsugar=$request["anc4_bloodsugar"];
           $u->anc4_highrisk=$request["anc4_highrisk"];
           $u->anc4_hblevel=$request["anc4_hblevel"];
           $u->anc4_fundalheight=$request["anc4_fundalheight"];
           $u->anc4_Foetalheartrate=$request["anc4_Foetalheartrate"];
           $u->anc4_FoetalMovements=$request["anc4_FoetalMovements"];
           $u->anc4_Foetalpresentation=$request["anc4_Foetalpresentation"];
           $u->anc4_usg=$request["anc4_usg"];
          
            $asha = User::where('access_token', $request["access_token"])->first();
            $u->asha_id = $asha->id;
             $data=$u;
             
            if ($u->save()) {
                return response()->json(["code" => 200, "msg" => "Record Saved Successfully"]);
            } else {
                // Handle user not found
                $data = array("code" => 404, "msg" => "No User Found");
            }
            
           }
           else {
                // Handle user not found
                $data = array("code" => 404, "msg" => "No Patient Found");
            }
            
               
           }
             else {
                // Handle user not found
                $data = array("code" => 404, "msg" => "Invalid Request");
            }
            
        
        return response()->json($data);
    }

    public function ashaupdatepatient(Request $request)
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
            $u->asha_id = $asha->id;
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

    public function searchpatient(Request $request)
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
    public function getUserRole(Request $request){
        if ($request["access_token"]) {
            $token = trim($request["access_token"]);
            $user = User::where('access_token', $token)->first();
            if ($user) {
                $data["name"]=$user->name;                
                $data["role_id"]=$user->role_id;                
                return response()->json(["code" => 200, "user" => $data]);
            } else {
                // Handle user not found
                $data = array("code" => 404, "msg" => "No User Found");
                    }
            } else {
                $data = array("code" => 999, "msg" => "Invalid Request");
            }
            return response()->json($data);
    }
}
