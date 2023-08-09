<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Block;
class FaridkotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faridkot_blocks=[
            ["name"=>"Faridkot"],   
            ["name"=>"Jaito"],   
            ["name"=>"Sadiq"],   
            ["name"=>"Kotkapura"],   
            ["name"=>"Bajakhana"],   
            ["name"=>"Jand Sahib"],   
       ];
       Block::insert($faridkot_blocks);
    }
}
