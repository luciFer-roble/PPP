@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Reportes</li>
@endsection

@section('content')

    <div class="container-fluid" id="app">
        <div class="card mb-3 col-md-10 pl-0 pr-0">
            <reporte9-item :profesor="{{ $profesor }}" carrera="{{ $profesor->escuela->nombreescuela }}"></reporte9-item>
        </div>
    </div>


@stop