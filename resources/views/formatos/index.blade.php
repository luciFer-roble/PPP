@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Formatos</li>
@endsection

@section('content')

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3"  id="app">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <h1>FORMATOS</h1></div>

                                @if(Auth::user()->hasRole('coord')or Auth::user()->hasRole('admin'))
                            <div class="btn-group mr-2">
                                <formato-nuevo :rol="{{ Auth::user()->roles->first()}}" ></formato-nuevo>
                            </div>
                                    @endif
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="p-0 m-0 pl-1">Codigo</th>
                                        @if(Auth::user()->hasRole('admin') or Auth::user()->hasRole('prof'))
                                            <th class="p-0 m-0 pl-1">Carrera</th>
                                        @endif
                                        <th class="p-0 m-0 pl-1">Descripciones</th>
                                        <th class="p-0 m-0 pl-3">Archivos</th>
                                        @if(Auth::user()->hasRole('coord')or Auth::user()->hasRole('admin'))
                                        <th class="p-0 m-0"></th>
                                            @endif

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($formatos as $formato)
                                        <tr is="documento-item"  :formato="{{ $formato }}" descripcionn="{{ $formato->descripciontipodocumento }}"
                                            :rol="{{ Auth::user()->roles->first()}}" >

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