@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Empresa</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item active">Empresas</li>
@endsection

@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <form>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    <input type="button" onClick="location.href = 'empresas/create'" class="btn btn-sm btn-outline-secondary" value="NUEVA"></input>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h1>EMPRESAS</h1></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="jumbotron text-center">
                                    <h2>{{ $empresa->nombreempresa }}</h2>
                                    <p>
                                        <strong>Direccion:</strong> {{ $empresa->direccionempresa }}<br>
                                        <strong>Sector:</strong> {{ $empresa->sectorempresa }}<br>
                                        <strong>Telefono:</strong> {{ $empresa->telefonoempresa }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop