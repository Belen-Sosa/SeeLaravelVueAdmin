<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $admin = User ::create([
             'name' => 'root2',
             'career_id'=>1,
             'email'=> 'root2@gmail.com',
             'password' =>Hash::make('root')

        ]);
        

        //asignamos el rol del usuario , los roles asignados y creeados se pueden ver en RoleSeeder

        $admin->assignRole('root');
    }
}
