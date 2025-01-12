<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\author;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->count(50000)->create();
        // $this->call(AdminSeeder::class);
        // Author::factory()->count(10000)->create();
        //$this->call(OrderStatusSeeder::class);
        //    $this->call(StateSeeder::class);

        Author::factory()->count(50)->create();
    }
}
