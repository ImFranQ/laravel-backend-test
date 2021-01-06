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
            Geolocations::class,
        ]);
        
        \App\Models\User::factory(50)->create();
        \App\Models\Email::factory(300)->create();
    }
}
