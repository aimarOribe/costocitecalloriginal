<?php

namespace Database\Seeders;

use App\Models\Gg;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gg::create([
            'costototal' => 0.00,
        ]);
    }
}
