<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Outlet::create([
            "nama" => "Outlet Laundry",
            "alamat" => "Jalan Raya Nomor 7",
            "tlp" => "+628972228848"
        ]);
    }
}
