<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      //llamamos a los seeders necesarios para la carga principal.
      $this->call([
       
        UserSeeder::class
     
      ]);
    }
}
 