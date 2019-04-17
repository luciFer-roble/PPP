@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Estudiante</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/estudiantes">Estudiantes</a></li>
    <li class="breadcrumb-item active">{{ $estudiante->nombresestudiante.' '.$estudiante->apellidosestudiante }}</li>
@endsection

@section('content')

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">


                    <!-- Example DataTables Card-->
                    <div class="card card-info">
                        <div class="card-header">
                            <h2>{{ $estudiante->nombresestudiante.' '.$estudiante->apellidosestudiante }}</h2>
                        </div>
                        <form role="form">

                                <div class="card-body">
                                    <p>
                                        <strong>Carrera:</strong> {{ $estudiante->carrera->nombrecarrera }}<br>
                                        <strong>Cedula:</strong> {{ $estudiante->cedulaestudiante }}<br>
                                        <strong>Celular:</strong> {{ $estudiante->celularestudiante }}<br>
                                        <strong>Correo Electronico:</strong> {{ $estudiante->correoestudiante }}<br>
                                        <strong>Fecha de Nacimiento:</strong> {{ $estudiante->fechanacimientoestudiante }}
                                    </p>
                                </div>

                                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


@stop