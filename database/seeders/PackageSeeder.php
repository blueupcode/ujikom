<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            "id_outlet" => 1,
            "nama_paket" => "Cuci baju anak",
            "jenis" => "kiloan",
            "harga" => 5000,
        ]);
        Package::create([
            "id_outlet" => 1,
            "nama_paket" => "Cuci baju dewasa",
            "jenis" => "kiloan",
            "harga" => 7000,
        ]);
        Package::create([
            "id_outlet" => 1,
            "nama_paket" => "Bed cover besar",
            "jenis" => "bed_cover",
            "harga" => 10000,
        ]);
        Package::create([
            "id_outlet" => 1,
            "nama_paket" => "Bed cover besar",
            "jenis" => "bed_cover",
            "harga" => 15000,
        ]);
        Package::create([
            "id_outlet" => 1,
            "nama_paket" => "Baju olahraga",
            "jenis" => "kaos",
            "harga" => 3000,
        ]);
    }
}
