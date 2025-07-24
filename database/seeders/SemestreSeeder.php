<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semestre;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Semestre::insert([
            ['semestre' => '2024-1'],
            ['semestre' => '2024-2'],
            ['semestre' => '2025-1'],
            ['semestre' => '2025-2'],
            ['semestre' => '2026-1'],
            ['semestre' => '2026-2'],
        ]);
    }
}
