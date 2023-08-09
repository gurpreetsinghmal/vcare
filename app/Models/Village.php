<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Block;

class Village extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'block_id',
    ];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
}
