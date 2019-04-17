@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Tutor Empresarial</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/tutores">Tutores</a></li>
    <li class="breadcrumb-item active">{{ $tutore->nombretutore.' '.$tutore->apellidotutore}}</li>
@endsection

@section('content')

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">


                    <!-- Example DataTables Card-->
                    <div class="card card-info">
                        <div class="card-header">
                            <h2>{{ $tutore->nombretutore.' '.$tutore->apellidotutore }}</h2>
                        </div>
                        <form role="form">

                                <div class="card-body">
                                    <p>
                                        <strong>Empresa:</strong> {{ $tutore->empresa->nombreempresa }}<br>
                                        <strong>Celular:</strong> {{ $tutore->celulartutore }}<br>
                                        <strong>Correo Electronico:</strong> {{ $tutore->correotutore }}<br>
                                    </p>
                                </div>

                                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


@stop