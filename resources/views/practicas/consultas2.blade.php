@extends('layouts.master')

@section('titulo')
    <h1 class="m-0 text-dark"></h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="#">Consultas</a></li>
    <li class="breadcrumb-item active">Practicas</li>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->

        <div class="row">
            <div class="col-12" id="app">


                <consulta2-praticas></consulta2-praticas>

            </div>
        </div>
    </div>

@stop