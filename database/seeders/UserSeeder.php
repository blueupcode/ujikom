<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "nama" => "Admin",
            "username" => "admin",
            "password" => Hash::make("12345678"),
            "id_outlet" => 1,
            "role" => "admin"
        ]);
        User::create([
            "nama" => "Kasir",
            "username" => "kasir",
            "password" => Hash::make("12345678"),
            "id_outlet" => 1,
            "role" => "kasir",
        ]);
        User::create([
            "nama" => "Owner",
                "username" => "owner",
                "password" => Hash::make("12345678"),
                "id_outlet" => 1,
                "role" => "owner",
        ]);
    }
}
