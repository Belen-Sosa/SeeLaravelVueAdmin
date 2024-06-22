<?php

namespace Database\Seeders;

use App\Models\TypeQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeQuestion ::create([
            'name' => 'Selección Única',
            'description'=>'Se podrá escoger solo una opción',
        
       ]);
       TypeQuestion ::create([
        'name' => 'Selección Múltiple',
        'description'=>'Se podrá escoger más de una opción',
       

   ]);
   TypeQuestion ::create([
    'name' => 'Texto',
    'description'=>'Se almacenara la respuesta',
   

]);
       
    }
}
