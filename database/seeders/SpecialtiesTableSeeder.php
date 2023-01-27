<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Specialty;
use App\Models\User;
class SpecialtiesTableSeeder extends Seeder
{
    public function run()
    {
        $specialties =[
            'Cirugía',
            'Oncología',
           'Fisioterapia',
            'Rehabilitación',
            'Imagenología (diagnóstico por imagen)',
            'Fauna Silvestre'
        ];
        foreach ($specialties as $specialtyName){
            $specialty = Specialty::create([
                'name'=>$specialtyName
            ]);

            $specialty->users()->saveMany(
                User::factory(4)->state(['role'=>'doctor'])->make()
            );
        }
        User::find(3)->specialties()->save($specialty);
    }
}
