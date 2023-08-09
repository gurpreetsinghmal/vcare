<?php

namespace Database\Seeders;

use App\Models\DBVMappings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DBVMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapping=[
            ["district_id"=>4,"block_id"=>1,],
            ["district_id"=>4,"block_id"=>2,],
            ["district_id"=>4,"block_id"=>3,],
            ["district_id"=>4,"block_id"=>4,],
            ["district_id"=>4,"block_id"=>5,],
            ["district_id"=>4,"block_id"=>6,],
       ];
       DBVMappings::insert($mapping);
    }
}
