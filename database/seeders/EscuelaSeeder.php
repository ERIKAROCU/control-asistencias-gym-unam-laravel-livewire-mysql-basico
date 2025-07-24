<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Escuela;

class EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Escuela::insert([
            ['escuela' => 'INGENIERIA DE SISTEMAS E INFORMATICA'],
            ['escuela' => 'INGENIERIA AMBIENTAL'],
            ['escuela' => 'INGENIERIA PESQUERA'],
            ['escuela' => 'DERECHO'],
            ['escuela' => 'CONTABILIDAD'],      
            ['escuela' => 'ADMINISTRACION'],
        ]);
    }
}
