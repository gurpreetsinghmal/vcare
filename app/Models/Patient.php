<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'husbandName',
        'village_id',
        'mobile',
        'currDeliveryCount',
        'prevChildAge',
        'previousDeliveryType',
        'sexPreviousChild',
        'tt1switch',
        'tt2switch',
        'ttbswitch',
        'counsDiet',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
