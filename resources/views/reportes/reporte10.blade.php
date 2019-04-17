@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Reportes</li>
@endsection

@section('content')

    <div class="container-fluid" id="app">
        <div class="card mb-3 col-md-11 pt-2">
            <reporte10-item :estudiante="{{ $estudiante }}" carrera="{{ $estudiante->carrera->nombrecarrera }}"></reporte10-item>
        </div>
    </div>


@stop