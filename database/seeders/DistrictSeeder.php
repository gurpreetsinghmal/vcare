<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\District;


class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $names=[
                ["name"=>"Amritsar"],
                ["name"=>"Barnala"],
                ["name"=>"Bathinda"],
                ["name"=>"Faridkot"],
                ["name"=>"Fatehgarh Sahib"],
                ["name"=>"Fazilka"],
                ["name"=>"Ferozepur"],
                ["name"=>"Gurdaspur"],
                ["name"=>"Hoshiarpur"],
                ["name"=>"Jalandhar"],
                ["name"=>"Kapurthala"],
                ["name"=>"Ludhiana"],
                ["name"=>"Malerkotla"],
                ["name"=>"Mansa"],
                ["name"=>"Moga"],
                ["name"=>"Muktsar"],
                ["name"=>"Nawanshahr (Shahid Bhagat Singh Nagar)"],
                ["name"=>"Pathankot"],
                ["name"=>"Patiala"],
                ["name"=>"Rupnagar"],
                ["name"=>"Sahibzada Ajit Singh Nagar (Mohali)"],
                ["name"=>"Sangrur"],
                ["name"=>"Tarn Taran"]
            ];
            District::insert($names);
           
            

    }
}
