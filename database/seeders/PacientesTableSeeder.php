<?php

namespace Database\Seeders;


use Database\Factories\PacienteFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       PacienteFactory::new()->count(100)->create();
    }
}
