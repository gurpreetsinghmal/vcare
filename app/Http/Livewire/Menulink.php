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
    public $stat = [
        "total" => 0,
        "anc1" => 0,
        "anc2" => 0,
        "anc3" => 0,
        "anc4" => 0,
        "delivered" => 0,
    ];
    public $block = "";
    public $repo = [];
    public $data_deliver = [];
    public $data_highrisk = [];
    public $data_anc1 = [];
    public $data_anc2 = [];
    public $data_anc3 = [];
    public $data_anc4 = [];
    public $reporttotalmodal = false;
    public $reportdelivermodal = false;
    public $reporthighriskmodal = false;
    public $reportanc1modal = false;
    public $reportanc2modal = false;
    public $reportanc3modal = false;
    public $reportanc4modal = false;



    public function getuser($id)
    {
       
        $u=User::where('id', $id)->get(['name','mobile'])->first();
        if($u){
            return $u->name.' '.$u->mobile;
        }
        return "NA";
    }
    public function getblock($villageid)
    {
        
        $b = DBVMappings::where('village_id', $villageid)->first();
        return $b->block->name;
    }
    public function getanm($villageid)
    {

        $b = AllUserMapping::where('village_id', $villageid)->first();
       
        return $this->getuser($b->anm_id);
    }

    public function report_deliver()
    {

        $this->toggle("reportdelivermodal");
    }

    public function report_highrisk()
    {
        $this->toggle("reporthighriskmodal");
    }
    public function report_anc1()
    {
        $this->toggle("reportanc1modal");
    }
    public function report_anc2()
    {
        $this->toggle("reportanc2modal");
    }
    public function report_anc3()
    {
        $this->toggle("reportanc3modal");
    }
    public function report_anc4()
    {
        $this->toggle("reportanc4modal");
    }
    public function report_total()
    {
        if (Auth::user()->role->id == 5) {
            $vill = AllUserMapping::where('smo_id', Auth::user()->id)->pluck('village_id')->toArray();
            $anms = AllUserMapping::where('smo_id', Auth::user()->id)->distinct()->pluck('anm_id');
            foreach ($anms as $a) {
                $asha = AllUserMapping::where('anm_id', $a)->pluck('asha_id');
                $u = User::where('id', $a)->get('name')->first();
                $this->repo[$u->name] = Patient::whereIn('village_id', $vill)->whereIn('asha_id', $asha)->count();
            }
        }
        if (Auth::user()->role->id == 6) {
            $vill = AllUserMapping::where('cmo_id', Auth::user()->id)->pluck('village_id')->toArray();
            $smos = AllUserMapping::where('cmo_id', Auth::user()->id)->distinct()->pluck('smo_id');
            foreach ($smos as $a) {
                $asha = AllUserMapping::where('smo_id', $a)->pluck('asha_id');
                $u = User::where('id', $a)->get('name')->first();
                $this->repo[$u->name] = Patient::whereIn('village_id', $vill)->whereIn('asha_id', $asha)->count();
            }
        }

        $this->toggle("reporttotalmodal");
    }
    public function mount()
    {
        //smo
        if (Auth::user()->role->id == 5) {
            $v = AllUserMapping::where('smo_id', Auth::user()->id)->first();
            $this->block = DBVMappings::where('village_id', $v->village_id)->first();
            $vill = AllUserMapping::where('smo_id', Auth::user()->id)->distinct()->pluck('village_id')->toArray();
        }

        //cmo
        if (Auth::user()->role->id == 6) {
            $v = AllUserMapping::where('cmo_id', Auth::user()->id)->first();
            $this->block = DBVMappings::where('village_id', $v->village_id)->first();
            $vill = AllUserMapping::where('cmo_id', Auth::user()->id)->distinct()->pluck('village_id')->toArray();
        }

        $this->stat["total"] = Patient::whereIn('village_id', $vill)->count();
        $anc1days = Carbon::now()->subWeek(12);
        $this->stat["anc1"] = Patient::whereIn('village_id', $vill)->where('Lmp', '<', $anc1days)->whereNull('anc1_date')->count();
        $anc2days = Carbon::now()->subWeek(28);
        $this->stat["anc2"] = Patient::whereIn('village_id', $vill)->where('Lmp', '<', $anc2days)->whereNull('anc2_date')->count();
        $anc3days = Carbon::now()->subMonth(7);
        $this->stat["anc3"] = Patient::whereIn('village_id', $vill)->where('Lmp', '<', $anc3days)->whereNull('anc3_date')->count();
        $anc4days = Carbon::now()->subMonth(8);
        $this->stat["anc4"] = Patient::whereIn('village_id', $vill)->where('Lmp', '<', $anc4days)->whereNull('anc4_date')->count();
        $this->stat["delivered"] = Patient::whereIn('village_id', $vill)->whereNotNull('dateofdelivery')->count();
        $this->stat["highrisk"] = Patient::whereIn('village_id', $vill)->where(function ($query) {
            $query->where('anc1_highrisk', 1)
                ->orWhere('anc2_highrisk', 1)
                ->orWhere('anc3_highrisk', 1)
                ->orWhere('anc4_highrisk', 1);
        })->count();
        //modal data
        $this->data_deliver = Patient::whereIn('village_id', $vill)->whereNotNull('dateofdelivery')->orderby('id', 'desc')->get();
        $this->data_highrisk = Patient::whereIn('village_id', $vill)->where(function ($query) {
            $query->where('anc1_highrisk', 1)
                ->orWhere('anc2_highrisk', 1)
                ->orWhere('anc3_highrisk', 1)
                ->orWhere('anc4_highrisk', 1);
        })->orderby('id', 'desc')->get();
        $this->data_anc1 = Patient::whereIn('village_id', $vill)->where('Lmp', '<', $anc1days)->whereNull('anc1_date')->get();
        $this->data_anc2 = Patient::whereIn('village_id', $vill)->where('Lmp', '<', $anc2days)->whereNull('anc2_date')->get();
        $this->data_anc3 = Patient::whereIn('village_id', $vill)->where('Lmp', '<', $anc3days)->whereNull('anc3_date')->get();
        $this->data_anc4 = Patient::whereIn('village_id', $vill)->where('Lmp', '<', $anc4days)->whereNull('anc4_date')->get();
    }
    public function render()
    {

        return view('livewire.menulink');
    }
    public function toggle($key)
    {

        switch ($key) {
            case "reporttotalmodal":
                $this->reporttotalmodal = !$this->reporttotalmodal;
                break;
            case "reportdelivermodal":
                $this->reportdelivermodal = !$this->reportdelivermodal;
                break;
            case "reporthighriskmodal":
                $this->reporthighriskmodal = !$this->reporthighriskmodal;
                break;
            case "reportanc1modal":
                $this->reportanc1modal = !$this->reportanc1modal;
                break;
            case "reportanc2modal":
                $this->reportanc2modal = !$this->reportanc2modal;
                break;
            case "reportanc3modal":
                $this->reportanc3modal = !$this->reportanc3modal;
                break;
            case "reportanc4modal":
                $this->reportanc4modal = !$this->reportanc4modal;
                break;
        }
    }
}
