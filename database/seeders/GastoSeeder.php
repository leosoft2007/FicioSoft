<?php

namespace Database\Seeders;

use App\Models\Gasto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gasto::factory()->count(50)->create();
    }
}
