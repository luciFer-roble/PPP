@extends('layouts.master')

@section('titulo')
    <h1 class="m-0 text-dark">{{ $practica->tipopractica .' '. $practica->tutore->empresa->nombreempresa}}</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ URL::to('practicas/' . $practica->idpractica . '/edit') }}">{{ $practica->tipopractica .' '. $practica->tutore->empresa->nombreempresa}}</a></li>
    <li class="breadcrumb-item active">Documentos</li>
@endsection
@section('content')
        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">


                    <!-- DataTable Card-->
                    <div class="card mb-3">
                        <div class="card-header ">
                            <div class="col-lg-6">
                                <h4>DOCUMENTOS</h4>
                            </div>
                        </div>
                        <div class="card-body" id="app">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Descripción del Documento</th>
                                        <th>Archivo</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tiposdocumento as $tipo)
                                        @php
                                            $documento = null;
                                            $codigo =null;
                                            $documentop =null;
                                        @endphp
                                        @foreach($documentosp as $doc)
                                            @if($doc->idtipodocumento == $tipo->idtipodocumento)
                                                @php
                                                    $documento = $doc->archivodocumentop;
                                                    $codigo = $doc->iddocumentop;
                                                $documentop = $doc;
                                                @endphp
                                            @endif
                                        @endforeach

                                        <tr is="documentop" :practica="{{ $practica }}" :tipo="{{ $tipo }}"  documento="{{ $documento }}" codigo="{{ $codigo }}" >

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