@extends('layouts.panel')

@section('content')


<div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Pacientes</h3>
                </div>
                <div class="col text-right">
                  <a href="{{url('pacientes/create')}}" class="btn btn-sm btn-primary">Nuevo Paciente</a>
                </div>
              </div>
            </div>
            <div class="card-body">
            @if(session('notification'))
                <div class="alert alert-success" role="alert">
                    {{session('notification')}}
                </div>
            @endif
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Cedula</th>
                    <th scope="col">Nombre de la mascota</th>
                    <th scope="col">Opciones</th>
                   
                  </tr>
                </thead>
                <tbody>
                @foreach($patients as $paciente)
                  <tr>
                    <th scope="row">
                     {{$paciente->name}}
                    </th>
                    <td>
                    {{$paciente->email}}
                    </td>
                  
                    <td>
                    {{$paciente->cedula}}
                    </td>
                    <td>
                    {{$paciente->mascota_name}}
                    </td>
                    <td>
                     
                     <form action="{{url('/pacientes/'.$paciente->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <a href="{{url('/pacientes/'.$paciente->id.'/edit')}}" class="btn btn-primary btn-sm">Editar</a>
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                     </form>
                    
                    </td>
                    
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
</div>
        
@endsection
