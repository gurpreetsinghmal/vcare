<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Gurjinder',
            'role_id'=>'7',//admin
            'district_id'=>null,
            'block_id'=>null,
            'village_id'=>null,
            'mobile' => '1234567890',
            'email' => 'dio-frd@nic.in',
            'password' => HASH::make('12345678'),
        ]);
    }
}
