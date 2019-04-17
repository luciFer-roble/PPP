@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Convenios</li>
@endsection

@section('content')

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3" id="app">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <h1>CONVENIOS</h1></div>
                            <convenio-nuevo :rol="{{ Auth::user()->roles->first() }}"></convenio-nuevo>
                        </div>
                        </div>
                        <div class="card-body" >
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Sede</th>
                                        <th>Empresa</th>
                                        <th>Descripción</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Archivo</th>
                                        <td colspan="2"></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($convenios as $convenio)
                                        <tr is="convenio-item"  :convenio="{{ $convenio }}"
                                          sede="{{ $convenio->sede->nombresede }}"
                                            empresa="{{ $convenio->empresa->nombreempresa }}">

                                        </tr>
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