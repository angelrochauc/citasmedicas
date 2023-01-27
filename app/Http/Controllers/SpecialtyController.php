<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;

class SpecialtyController extends Controller
{
   
    public function index(){
        $specialties=Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create(){
        return view('specialties.create');
    }

    public function senData(Request $request){
        $rules=[
            'name' => 'required|min:3'
        ];

        $message=[
            'name.require' => 'Campo especilidad obligatorio',
            'name.min' => 'Minimo 3 caracteres en el campo especialidad'
        ];
        $this->validate($request, $rules, $message);


        $specialty=new Specialty();
        $specialty->name=$request->input('name');
        $specialty->description=$request->input('description');
        $specialty->save();
        $notification='La especialidad se creo correctamente';
        
        return redirect('/especialidades')->with(compact('notification'));
    }

    public function edit(Specialty $specialty){
        return view('specialties.edit', compact('specialty'));
    }


    public function update(Request $request, Specialty $specialty){
        $rules=[
            'name' => 'required|min:3'
        ];

        $message=[
            'name.require' => 'Campo especilidad obligatorio',
            'name.min' => 'Minimo 3 caracteres en el campo especialidad'
        ];
        $this->validate($request, $rules, $message);

        $specialty->name=$request->input('name');
        $specialty->description=$request->input('description');
        $specialty->save();
        $notification='Actualizacion correctamente';
        
        return redirect('/especialidades')->with(compact('notification'));
    }
    public function destroy(Specialty $specialty){
        $deleteName=$specialty->name;
       $specialty->delete();
       $notification='La especialidad '.$deleteName.' se elimino correctamente';
       return redirect('/especialidades')->with(compact('notification'));
    }

}
