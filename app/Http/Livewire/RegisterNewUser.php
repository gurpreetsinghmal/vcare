<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;

use App\Models\DBVMappings;
use App\Models\District;
use Illuminate\Console\View\Components\Alert;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;



class RegisterNewUser extends Component
{
    public $user = [
        "name" => "",
        "mobile" => "",
        "email" => "",
        "password" => "",
        "role_id" => null,
        "district_id" => null,
        "block_id" => null,
        "village_id" => null,
    ];

    public $name = "";
    public $mobile = "";
    public $email = "";
    public $password = "12345678";
    public $password_confirmation = "12345678";
    public $role = "";
    public $district = "";
    public $message = "";

    public $role_options = [];
    public $district_options = [];
    public $block_options = [];
    public $village_options = [];

    public $authroles = [];
    public $authdisctricts = [];


    public function render()
    {
        $userrole = Auth::user()->role_id;

        if ($userrole == 7) {
            //if admin only create cmo
            $this->district_options = District::all();
            $this->role_options = Role::where('id', "=", 6)->get();
        } else if ($userrole == 6) {
            //if cmo only create smo
            $userdistrict = Auth::user()->district_id;
            $this->user["district_id"] = $userdistrict;
            $this->block_options = DBVMappings::where('district_id', $userdistrict)->get();
            $this->role_options = Role::where('id', "=", 5)->get();
        } else if ($userrole == 5) {
            //if smo create any user below him
            $userdistrict = Auth::user()->district_id;
            $this->user["district_id"] = $userdistrict;
            $this->user["block_id"] = Auth::user()->block_id;
            $this->role_options = Role::whereIn('id', [1,2, 3, 4])->get();
        }
        else if ($userrole == 2) {
            //if smo create any user below him
            $userdistrict = Auth::user()->district_id;
            $this->user["district_id"] = Auth::user()->district_id;
            $this->user["block_id"] = Auth::user()->block_id;
            $this->village_options = DBVMappings::where('district_id', $userdistrict)
            ->where('block_id', Auth::user()->block_id)->get();
            $this->role_options = Role::whereIn('id', [1])->get();
        }

        // $this->authroles = [];
        // foreach ($this->role_options as $r) {
        //     $this->authroles[] = $r->id;
        // }

        // $this->authdisctricts = [];
        // foreach ($this->district_options as $r) {
        //     $this->authdisctricts[] = $r->id;
        // }


        return view('livewire.register-new-user');
    }

    public function register()
    {
        
       
        Validator::make(
            $this->user,
            [

                'name' => 'required|string|max:255',
                'mobile' => 'required|string|min:10|max:10|unique:users',
                'email' => 'nullable|string|email|max:255',
                // 'password' => 'required|string|min:8|confirmed',
                'district_id' => 'required',
                'role_id' => 'required',
            ],
            [
                'name.required' => 'Please provide a valid Name.',
                'mobile.required' => 'Please provide a valid Mobile.',
                'password.required' => 'Please provide a Password.',
                'district.required' => 'Selection of District is mandatory.',
                'role.required' => 'Selection of Role is mandatory.',

                // Add more custom messages for other rules as needed.
            ]
        )->validate();
        
        // if($this->user['role_id']==1 && ($this->user['village_id']==null || $this->user['village_id']=="")){
        //     $this->message="Selection of Village is mandatory";
        //     return;
        // }else
        // {
        //     $this->message="";
        // }
                      
        // $this->user['password'] = Hash::make($this->user['password']);
        $this->user['password'] = Hash::make('12345678');

        $user = User::create($this->user);
        if ($user) {
            $this->dispatchBrowserEvent('success', ['message' => "New User Added!!"]);
        } else {
            $this->dispatchBrowserEvent('error', ['message' => "Something went wrong!!"]);
        }

        $this->user = [
            "name" => "",
            "mobile" => "",
            "email" => "",
            "password" => "",
            "role_id" => null,
            "district_id" => null,
            "block_id" => null,
            "village_id" => null,
        ];
        $this->emit('toggle', 'adduser');
    }
}
