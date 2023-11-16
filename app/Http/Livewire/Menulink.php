<?php

namespace App\Http\Livewire;

use App\Models\AllUserMapping;
use App\Models\DBVMappings;
use App\Models\Patient;
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
    public function mount(){
        $v=AllUserMapping::where('smo_id',Auth::user()->id)->first();
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
    public function render()
    {

        return view('livewire.menulink');
    }
}
