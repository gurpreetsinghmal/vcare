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
        'village',
        'mobile',
        'currDeliveryCount',
        'prevChildAge',
        'previousDeliveryType',
        'sexPreviousChild',
        'tt1Switch',
        'tt2Switch',
        'ttbswitch',
        'counsDiet',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
