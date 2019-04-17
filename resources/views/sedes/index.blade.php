@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Sedes</li>
@endsection

@section('content')

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3" id="app">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <h1>SEDES</h1></div>
                            <div class="btn-group mr-2">
                                <sedes-nuevo></sedes-nuevo>

                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="p-0 m-0">Codigo</th>
                                        <th class="p-0 m-0">Nombre</th>
                                        <th class="p-0 m-0">Descripcion</th>
                                        <th class="p-0 m-0">Universidad</th>
                                        <td ></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sedes as $sede)
                                        <tr is="sedes-componente" :sede="{{ $sede }}" :universidad="{{ $sede->universidad }}"></tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>

                </div>
            </div>
        </div>


@stop