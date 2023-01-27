<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;

class PatientController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients=User::patients()->get();
     return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
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
        User::create(
            $request->only('name','email','cedula', 'address','phone') 
            + ['role'=> 'paciente',
            'password'=>bcrypt($request->input('password'))]
        );
        $notification = "Paciente registrado correctamente";
        return redirect('/pacientes')->with(compact('notification'));
    }

   
    public function show($id)
    {
     
    }

   
    public function edit($id)
    {
        $patient=User::Patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
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
        $user = User::Patients()->findOrFail($id);
        $data= $request->only('name','email','cedula', 'address','phone') ;
        $password=$request->input('password');
     
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();
        $notification = "Informacion del paciente actualizada correctamente";
        return redirect('/pacientes')->with(compact('notification'));
    }

    
    public function destroy($id)
    {
        $user= User::Patients()->findOrFail($id);
        $PacienteName=$user->name;
        $user->delete();
        $notification="Paciente $PacienteName eliminado correctamente";
        return redirect('/pacientes')->with(compact('notification'));
}
}