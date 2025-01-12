<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookFormat;

class BookFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookFormat::create(['name' => 'PaperBack']);
        BookFormat::create(['name' => 'HardCover']);
    }
}
