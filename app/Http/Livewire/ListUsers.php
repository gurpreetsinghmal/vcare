<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AllUserMapping;
use App\Models\DBVMappings;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ListUsers extends Component
{
    public $search = "";
    public $users = "";
    public $password = "";
    public $password_confirmation = "";
    public $err = "";

    public $cpwd = false;
    public $adduser = false;

    public $userdata = [
        "id" => "",
        "password" => "",
        "password_confirmation" => ""
    ];

    protected $listeners = ['toggle'];

    public function render()
    {
        $userrole = Auth::user()->role_id;
       
        
        // $level=Auth::user()->cmo_id;
        $this->users = User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
            $query->orWhere('email', 'like', '%' . $this->search . '%');
            $query->orWhere('mobile', 'like', '%' . $this->search . '%');
        })->where('role_id', '<', $userrole)->orderby('role_id', 'desc')->get();
        
      
        $dist=null;$block=null;
        
        foreach($this->users as $u){
            if($u->role_id==6){
            $village=AllUserMapping::where("cmo_id",$u->id)->get('village_id')->first();
            $map=DBVMappings::where("village_id",$village->village_id)->first();
            $dist[$u->id]=$map->district->name;
            $block[$u->id]=$map->block->name;
            }
            if($u->role_id==5){
            $village=AllUserMapping::where("smo_id",$u->id)->get('village_id')->first();
            $map=DBVMappings::where("village_id",$village->village_id)->first();
            $dist[$u->id]=$map->district->name;
            $block[$u->id]=$map->block->name;
            }
             if($u->role_id==4){
            $village=AllUserMapping::where("gyno_id",$u->id)->get('village_id')->first();
            $map=DBVMappings::where("village_id",$village->village_id)->first();
            $dist[$u->id]=$map->district->name;
            $block[$u->id]=$map->block->name;
            }
             if($u->role_id==3){
            $village=AllUserMapping::where("doctor_id",$u->id)->get('village_id')->first();
            $map=DBVMappings::where("village_id",$village->village_id)->first();
            $dist[$u->id]=$map->district->name;
            $block[$u->id]=$map->block->name;
            }
             if($u->role_id==2){
            $village=AllUserMapping::where("anm_id",$u->id)->get('village_id')->first();
            if($village!=null){
                $map=DBVMappings::where("village_id",$village->village_id)->first();
                $dist[$u->id]=$map->district->name;
                $block[$u->id]=$map->block->name;
            }
            
            }
             if($u->role_id==1){
            $village=AllUserMapping::where("asha_id",$u->id)->get('village_id')->first();
            
            $map=DBVMappings::where("village_id",$village->village_id)->first();
            $dist[$u->id]=$map->district->name;
            $block[$u->id]=$map->block->name;
            }
           
        }
       
        return view('livewire.list-users',["dist"=>$dist,"block"=>$block]);
    }

    public function changepwd($id)
    {
        $this->userdata["id"] = $id;
        $this->toggle("changepwd");
    }

    public function adduserfun()
    {
        $this->toggle("adduser");
    }

    public function save()
    {

        Validator::make(
            $this->userdata,
            [
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'password.required' => 'Please provide a Password.',
                'password.min' => 'Passwrod length must be 8',
                'password.confirmed' => 'Passwrod Must match Confirm Password',
                // Add more custom messages for other rules as needed.
            ]
        )->validate();


        $person = User::find($this->userdata['id']);
        $person->password = Hash::make($this->userdata['password']);
        $person->save();
        $this->dispatchBrowserEvent('success', ['message' => "Password Updated Successfully!!"]);
        $this->userdata = [
            "id" => "",
            "password" => "",
            "password_confirmation" => ""
        ];
                
        $this->toggle("changepwd");
    }

    public function toggle($key)
    {

        switch ($key) {
            case "changepwd":
                $this->cpwd = !$this->cpwd;
                break;
            case "adduser":
                $this->adduser = !$this->adduser;
                break;
        }
    }
}
