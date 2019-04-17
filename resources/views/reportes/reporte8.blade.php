@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Reportes</li>
@endsection

@section('content')

    <div class="container-fluid" id="app">
        <div class="card mb-3">
            <reporte8-item :estudiante="{{ $estudiante->first() }}"></reporte8-item>
        </div>
    </div>


@stop