<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Angel Rocha',
            'email' => 'angelrochateinco@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'cedula'=>'12222222',
            'address'=>'Av Caracas',
            'phone'=>'55667',
            'role'=>'admin',
            
        ]);
        User::create([
            'name' => 'Gabriela Vega',
            'email' => 'paciente1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'role'=>'paciente',
            
        ]);
        User::create([
            'name' => 'Miguel Guerrero',
            'email' => 'medico1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'role'=>'doctor',
            
        ]);
      

        User::factory()
            ->count(10)
            ->state(['role'=>'paciente'])
            ->create();
    }
}
