<?php

namespace App\Http\Livewire;

use App\Models\AllUserMapping;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Mapuser extends Component
{
    use WithPagination;
    public function render()
    {
        $map=AllUserMapping::get();
        return view('livewire.mapuser',["allmap"=>$map]);
    }
}
