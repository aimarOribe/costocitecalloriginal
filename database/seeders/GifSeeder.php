<?php

namespace Database\Seeders;

use App\Models\Gif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gif::create([
            'costototal' => 0.00,
        ]);
    }
}
