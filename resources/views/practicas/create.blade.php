@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nueva Practica</h1>
    <meta name="_token" content="{{ csrf_token() }}">
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/practicas">Practicas</a></li>
    <li class="breadcrumb-item active">Nueva</li>
@endsection
@section('content')
    <div class="container-fluid" id="app">
        <nueva-practica ></nueva-practica>
    </div>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
@stop