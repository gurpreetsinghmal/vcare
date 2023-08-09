<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\Block;
use App\Models\Village;

class DBVMappings extends Model
{
    use HasFactory;
    protected $fillable = [
        'district_id',
        'block_id',
        'village_id',

    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function block()
    {
        return $this->belongsTo(Block::class);
    }
    public function village()
    {
        return $this->belongsTo(Village::class);
    }

   
}
