<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facultad;

class FacultadSeeder extends Seeder
{
   
    public function run(): void {
  foreach ([
    'Ingeniería en Sistemas', 'Medicina', 'Derecho', 'Arquitectura',
    'Administración', 'Ciencias Económicas'
  ] as $n) Facultad::firstOrCreate(['nombre'=>$n]);
}
}
