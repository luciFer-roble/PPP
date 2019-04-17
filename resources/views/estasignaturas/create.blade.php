@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Registrar Asignaturas</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="#">{{ $estudiante->nombre1estudiante .' '.$estudiante->apellido1estudiante }}</a></li>
    <li class="breadcrumb-item active">Asignaturas</li>
@endsection
@section('content')
    <div class="container-fluid" id="app" >
        <div class="row">
            <div class="col-md-2"></div>

            <div class="col-md-8">
                    <div class="card">
                    <div class="card-body">

                            <listarasignatura codigo="{{ $idcarrera }} " estudiante="{{ $estudiante->idestudiante }}" :asignaturas="{{ $asignaturas }}">

                            </listarasignatura>
                    </div>
                    <hr>

                    <div class="card-footer">
                        <a href="#" onclick="history.go(-1)" class="btn btn-primary float-right">OK</a>
                    </div>
                    </div>
            </div>

            <div class="col-md-2"></div>


        </div>
    </div>
    <script>

    </script>
@stop