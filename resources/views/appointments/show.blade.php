@extends('layouts.panel')

@section('content')


<div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Citas #{{$appointment->id}}</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
                <ul>
                    <dd>
                        <strong>Fecha:</strong>{{$appointment->scheduled_date}}
                    </dd>
                    <dd>
                        <strong>Hora de atencion:</strong>{{$appointment->scheduled_time_12}}
                    </dd>
                    <dd>
                        <strong>Doctor:</strong>{{$appointment->doctor->name}}
                    </dd>
                    <dd>
                        <strong>Especialidad:</strong>{{$appointment->specialty->name}}
                    </dd>
                    <dd>
                        <strong>Tipo de consulta:</strong>{{$appointment->type}}
                    </dd>
                    <dd>
                        <strong>Estado:</strong>{{$appointment->status}}
                    </dd>
                    <dd>
                        <strong>Sisntomas:</strong>{{$appointment->description}}
                    </dd>
                </ul>
                <div class="alert bg-light text-primary">
                    <h3>Detalles de la cancelacion</h3>
                    @if($appointment->cancellation)
                    <ul>
                        <li>
                            <strong>Fecha de cancelacion:</strong>
                            {{$appointment->cancellation->created_at}}
                        </li>
                        <li>
                            <strong>Cita cancelada por:</strong>
                            {{$appointment->cancellation->created_by}}
                        </li>
                        <li>
                            <strong>Motivo de cancelacion:</strong>
                            {{$appointment->cancellation->justification}}
                        </li>
                    </ul>
                    @else
                    <ul>
                        <li>La cita fue cancelada antes de la confirmacion</li>
                    </ul>
                    @endif

                </div>

            </div>
           
           
</div>
        
@endsection
