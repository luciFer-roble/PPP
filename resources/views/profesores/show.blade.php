@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Profesor</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/profesores">Profesores</a></li>
    <li class="breadcrumb-item active">{{ $profesor->nombresprofesor.' '.$profesor->nombre2profesor.' '.$profesor->apellidosprofesor.' '.$profesor->apellido2estuduante }}</li>
@endsection

@section('content')

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">


                    <!-- Example DataTables Card-->
                    <div class="card card-info">
                        <div class="card-header">
                            <h2>{{ $profesor->nombresprofesor.' '.$profesor->apellidosprofesor }}</h2>
                        </div>
                        <form role="form">

                                <div class="card-body">
                                    <p>
                                        <strong>Escuela:</strong> {{ $profesor->escuela->nombreescuela }}<br>
                                        <strong>Celular:</strong> {{ $profesor->celularprofesor }}<br>
                                        <strong>Correo Electronico:</strong> {{ $profesor->correoprofesor }}<br>
                                        <strong>Oficina:</strong> {{ $profesor->oficinaprofesor }}
                                    </p>
                                </div>

                                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


@stop