@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Coordinador</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/coordinadores">Coordinadores</a></li>
    <li class="breadcrumb-item active">{{ $coordinador->profesor->nombre1profesor.' '.$coordinador->profesor->nombre2profesor.' '.$coordinador->profesor->apellido1profesor.' '.$coordinador->apellido2profesor }}</li>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">


                <!-- Example DataTables Card-->
                <div class="card card-info">
                    <div class="card-header">
                        <h2>{{ $coordinador->profesor->nombre1profesor.' '.$coordinador->profesor->nombre2profesor.' '.$coordinador->profesor->apellido1profesor.' '.$coordinador->apellido2profesor }}</h2>
                    </div>
                    <form role="form">

                        <div class="card-body">
                            <p>
                                        <strong>Carrera:</strong> {{ $coordinador->carrera->nombrecarrera }}<br>
                                        <strong>Correo:</strong> {{ $coordinador->profesor->correoprofesor }}<br>
                                        <strong>Celular:</strong> {{ $coordinador->profesor->celularprofesor }}<br>
                                        <strong>Oficina:</strong> {{ $coordinador->profesor->oficinaprofesor }}
                            </p>
                        </div>

                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </form>
                </div>

            </div>
        </div>
    </div>


@stop