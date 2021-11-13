<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OutletSeeder::class,
            UserSeeder::class,
            PackageSeeder::class,
            MemberSeeder::class,
            TransactionSeeder::class,
            TransactionDetailSeeder::class,
        ]);
    }
}
