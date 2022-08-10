<?php

namespace Database\Seeders;

use App\Models\Dep;
use App\Models\Depreciacionmensual;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Depreciacionmensual::create([
            'total' => 0.00,
        ]);
    }
}
