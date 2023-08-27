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
        'tt1',
        'tt2',
        'ttb',
        'counsDiet',
        "rchid",
        "mothername",
      "ageatmarriage",
      "dob",
      "ashaid",
      "anmid",
      "gynoid",
      "moid",
      "bankname",
      "accountno",
      "ifsccode",
      "caste",
      "economy",
      "address",
      "regdate",
      "Lmp",
      "edd",
      "weight",
      "height",
      "pastillness",
      "JSYBeneficiary",
      "badhistory",
      "siteofdelivery",
   
      "anc1_date",
      "anc1_weekofpregnancy",
      "anc1_bpSystolic",
      "anc1_bpDiastolic",
      "anc1_fundalheight",
      "anc1_bloodsugarfasting",
      "anc1_bloodsugarpost",
      "anc1_highrisk",
      "anc1_hblevel",
      "anc1_urinesugar",
      "anc1_urinealbumin",
      "anc1_folictabcount",
      "anc1_folicdate",
      "anc1_ifatabcount",
      "anc1_ifadate",
      "anc1_counselling",
   
      "anc2_date",
      "anc2_bp",
      "anc2_bloodsugar",
      "anc2_highrisk",
      "anc2_hblevel",
      "anc2_fundalheight",
      "anc2_Foetal heart rate",
      "anc2_Foetal Movements",
      "anc2_usg",
   
      "anc3_date",
      "anc3_bp",
      "anc3_bloodsugar",
      "anc3_highrisk",
      "anc3_hblevel",
      "anc3_fundalheight",
      "anc3_Foetal heart rate",
      "anc3_Foetal Movements",
      "anc3_Foetal presentation",
      "anc3_usg",
   
      "anc4_date",
      "anc4_bp",
      "anc4_bloodsugar",
      "anc4_highrisk",
      "anc4_hblevel",
      "anc4_fundalheight",
      "anc4_Foetal heart rate",
      "anc4_Foetal Movements",
      "anc4_Foetal presentation",
      "anc4_usg",
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
