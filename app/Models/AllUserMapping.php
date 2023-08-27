<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllUserMapping extends Model
{
    use HasFactory;

    public function cmo()
    {
        return $this->belongsTo(User::class);
    }
    public function smo()
    {
        return $this->belongsTo(User::class);
    }
    public function gyno()
    {
        return $this->belongsTo(User::class);
    }
    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
    public function anm()
    {
        return $this->belongsTo(User::class);
    }
    public function asha()
    {
        return $this->belongsTo(User::class);
    }
    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
