<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Specialty;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors=User::doctors()->get();
     return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }


    public function store(Request $request)
    {

        $rules=[
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula'=>'required|digits:10',
            'address'=>'nullable|min:6',
            'phone'=>'required'
        ];
        $messages=[
            'name.required' => 'El nombre es obligatorio',
            'name.min' => 'El nombre debe tener minimo 3 caracteres',
            'email.required' => 'Correo Obligatorio',
            'email.email' => 'Ingresar un correo valido',
            'cedula.required'=>'Cedula obligatoria',
            'cedula.digits'=>'Cedula debe tener minimo 10 digitos',
            'address.min'=>'La direccion debe tener minimo 6 caracteres',
            'phone.required'=>'Telefono obligatorio'
        ];
        $this->validate($request, $rules, $messages);
        $user=User::create(
            $request->only('name','email','cedula', 'address','phone') 
            + ['role'=> 'doctor',
            'password'=>bcrypt($request->input('password'))]
        );

        $user->specialties()->attach($request->input('specialties'));
        $notification = "Medico registrado correctamente";
        return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor=User::doctors()->findOrFail($id);
        $specialties = Specialty::all();
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor', 'specialties', 'specialty_ids'));
    }

    
    public function update(Request $request, $id)
    {
        $rules=[
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula'=>'required|digits:10',
            'address'=>'nullable|min:6',
            'phone'=>'required'
        ];
        $messages=[
            'name.required' => 'El nombre es obligatorio',
            'name.min' => 'El nombre debe tener minimo 3 caracteres',
            'email.required' => 'Correo Obligatorio',
            'email.email' => 'Ingresar un correo valido',
            'cedula.required'=>'Cedula obligatoria',
            'cedula.digits'=>'Cedula debe tener minimo 10 digitos',
            'address.min'=>'La direccion debe tener minimo 6 caracteres',
            'phone.required'=>'Telefono obligatorio'
        ];
        $this->validate($request, $rules, $messages);
        $user = User::doctors()->findOrFail($id);
        $data= $request->only('name','email','cedula', 'address','phone') ;
        $password=$request->input('password');
     
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();
        $user->specialties()->sync($request->input('specialties'));


        $notification = "Informacion del medico actualizada correctamente";
        return redirect('/medicos')->with(compact('notification'));
    }

   
    public function destroy($id)
    {
        $user= User::doctors()->findOrFail($id);
        $doctorName=$user->name;
        $user->delete();
        $notification="Medico $doctorName eliminado correctamente";
        return redirect('/medicos')->with(compact('notification'));
    }
}
