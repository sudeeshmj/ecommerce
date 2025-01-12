<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'Best Seller']);
        Tag::create(['name' => 'Award Winning']);
        Tag::create(['name' => 'New Arrival']);
    }
}
