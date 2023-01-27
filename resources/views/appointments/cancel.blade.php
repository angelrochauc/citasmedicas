@extends('layouts.panel')

@section('content')


<div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Cancelar citas</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
            @if(session('notification'))
                <div class="alert alert-success" role="alert">
                    {{session('notification')}}
                </div>
            @endif
            
            <p>Se cancelara tu cita con el medico <b>{{$appointment->doctor->name}}</b>
            (especilidad  <b>{{$appointment->specialty->name}}</b>) para el dia <b>{{$appointment->scheduled_date}}</b></p>

            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    

                </div>

                <button class="btn btn-danger" type="submit">Cancelar cita</button>
            </form>

            </div>
           
           
</div>
        
@endsection
