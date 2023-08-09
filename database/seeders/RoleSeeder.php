<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  0 = reporting user
        //  1= ASHA user
        //  2= ANM user
        //  3= Doctor user
        //  4= SMO user
        //  5= CMO user
        //  10= Admin user
        $roles = [
            ["description" => "ASHA user"],
            ["description" => "ANM user"],
            ["description" => "GYNO user"],
            ["description" => "Doctor user"],
            ["description" => "SMO user"],
            ["description" => "CMO user"],
            ["description" => "Admin user"],
        ];
        Role::insert($roles);
    }
}
