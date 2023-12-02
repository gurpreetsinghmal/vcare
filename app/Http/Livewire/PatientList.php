<?php

namespace App\Http\Livewire;

use App\Models\AllUserMapping;
use App\Models\DBVMappings;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PatientList extends Component
{
    public $search = "";
    public $patients = "";
    public $completedetails="";
    public $viewpatient=false;

    public function getuser($id){
        //dd($id);
        return User::where('id',$id)->pluck('name')->first();
    }
    public function getblock($villageid){
        //dd($id);
        $b=DBVMappings::where('village_id',$villageid)->first();
        return $b->block->name;
    }
   
    public function render()
    {
        $u=Auth::user();
        //$this->completedetails=Patient::first();
        $dist=null;$block=null;
        if($u->role_id==6){
            //cmo login
            $village=AllUserMapping::where("cmo_id",$u->id)->get('village_id')->first();
            if($village){
            $map=DBVMappings::where("village_id",$village->village_id)->first();
            $dist[$u->id]=$map->district->name;
            $block[$u->id]="All Blocks";
        
            }

            $allvillages=AllUserMapping::where("cmo_id",$u->id)->distinct()->pluck('village_id')->toArray();;
            
            $this->patients=Patient::whereIn('village_id',$allvillages)->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
                $query->orWhere('husbandName', 'like', '%' . $this->search . '%');
                $query->orWhere('mobile', 'like', '%' . $this->search . '%');
            })->orderby('id', 'desc')->get();


        }
        if($u->role_id==5){
            //smo login
            $village=AllUserMapping::where("smo_id",$u->id)->get('village_id')->first();
            if($village){
            $map=DBVMappings::where("village_id",$village->village_id)->first();
            $dist[$u->id]=$map->district->name;
            $block[$u->id]=$map->block->name;
            }

            $allvillages=AllUserMapping::where("smo_id",$u->id)->distinct()->pluck('village_id')->toArray();;
            
            $this->patients=Patient::whereIn('village_id',$allvillages)->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
                //$query->orWhere('email', 'like', '%' . $this->search . '%');
                $query->orWhere('mobile', 'like', '%' . $this->search . '%');
            })->orderby('id', 'desc')->get();


        }
        return view('livewire.patient-list',["dist"=>$dist,"block"=>$block]);
    }

    public function viewdetails($id){
        $this->completedetails=Patient::where('id',$id)->get()->first();
        //dd($this->completedetails);
        $this->toggle("viewpatient");
    }

    public function toggle($key)
    {

        switch ($key) {
            case "viewpatient":
                $this->viewpatient = !$this->viewpatient;
                break;
    
        }
    }
}
