<?php

namespace App\Http\Livewire;

use App\Models\AllUserMapping;
use App\Models\DBVMappings;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Menulink extends Component
{
    public $stat=[
        "total"=>0,
        "anc1"=>0,
        "anc2"=>0,
        "anc3"=>0,
        "anc4"=>0,
        "delivered"=>0,
    ];
    public $block="";
    public $repo=[];
    public $reportmodal=false;
    public function toggle(){
        $this->reportmodal=!$this->reportmodal;
    }
    public function report()
    {
        if(Auth::user()->role->id==5){
        $vill=AllUserMapping::where('smo_id',Auth::user()->id)->pluck('village_id')->toArray();
        $anms=AllUserMapping::where('smo_id',Auth::user()->id)->distinct()->pluck('anm_id');
        foreach($anms as $a){
            $asha=AllUserMapping::where('anm_id',$a)->pluck('asha_id');
            $u=User::where('id',$a)->get('name')->first();
            $this->repo[$u->name]=Patient::whereIn('village_id', $vill)->whereIn('asha_id', $asha)->count();
        }
    }
    if(Auth::user()->role->id==6){
        $vill=AllUserMapping::where('cmo_id',Auth::user()->id)->pluck('village_id')->toArray();
        $smos=AllUserMapping::where('cmo_id',Auth::user()->id)->distinct()->pluck('smo_id');
        foreach($smos as $a){
            $asha=AllUserMapping::where('smo_id',$a)->pluck('asha_id');
            $u=User::where('id',$a)->get('name')->first();
            $this->repo[$u->name]=Patient::whereIn('village_id', $vill)->whereIn('asha_id', $asha)->count();
        }
    }

        $this->toggle();
    }
    public function mount(){
        //smo
        if(Auth::user()->role->id==5)
        {$v=AllUserMapping::where('smo_id',Auth::user()->id)->first();
        $this->block=DBVMappings::where('village_id',$v->village_id)->first();
        $vill=AllUserMapping::where('smo_id',Auth::user()->id)->pluck('village_id')->toArray();
        $this->stat["total"]=Patient::whereIn('village_id', $vill)->count();
        $anc1days = Carbon::now()->subWeek(12);
        $this->stat["anc1"]=Patient::whereIn('village_id', $vill)->where('Lmp','<', $anc1days)->whereNull('anc1_date')->count();
        $anc2days = Carbon::now()->subWeek(28);
        $this->stat["anc2"]=Patient::whereIn('village_id', $vill)->where('Lmp','<', $anc2days)->whereNull('anc2_date')->count();
        $anc3days = Carbon::now()->subMonth(7);
        $this->stat["anc3"]=Patient::whereIn('village_id', $vill)->where('Lmp','<', $anc3days)->whereNull('anc3_date')->count();
        $anc4days = Carbon::now()->subMonth(8);
        $this->stat["anc4"]=Patient::whereIn('village_id', $vill)->where('Lmp','<', $anc4days)->whereNull('anc4_date')->count();
        $this->stat["delivered"]=Patient::whereIn('village_id', $vill)->whereNotNull('dateofdelivery')->count();
        }

         //cmo
         if(Auth::user()->role->id==6)
         {
         $v=AllUserMapping::where('cmo_id',Auth::user()->id)->first();
         $this->block=DBVMappings::where('village_id',$v->village_id)->first();

         $vill=AllUserMapping::where('cmo_id',Auth::user()->id)->pluck('village_id')->toArray();
         $this->stat["total"]=Patient::whereIn('village_id', $vill)->count();
         $anc1days = Carbon::now()->subWeek(12);
         $this->stat["anc1"]=Patient::whereIn('village_id', $vill)->where('Lmp','<', $anc1days)->whereNull('anc1_date')->count();
         $anc2days = Carbon::now()->subWeek(28);
         $this->stat["anc2"]=Patient::whereIn('village_id', $vill)->where('Lmp','<', $anc2days)->whereNull('anc2_date')->count();
         $anc3days = Carbon::now()->subMonth(7);
         $this->stat["anc3"]=Patient::whereIn('village_id', $vill)->where('Lmp','<', $anc3days)->whereNull('anc3_date')->count();
         $anc4days = Carbon::now()->subMonth(8);
         $this->stat["anc4"]=Patient::whereIn('village_id', $vill)->where('Lmp','<', $anc4days)->whereNull('anc4_date')->count();
         $this->stat["delivered"]=Patient::whereIn('village_id', $vill)->whereNotNull('dateofdelivery')->count();
         }
    }
    public function render()
    {

        return view('livewire.menulink');
    }
}
