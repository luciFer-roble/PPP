@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Convenio</h1>
    @endsection
@section('nav')
<li class="breadcrumb-item"><a href="/">Inicio</a></li>
<li class="breadcrumb-item"><a href="/convenios">Convenios</a></li>
<li class="breadcrumb-item active">Nuevo</li>
    @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
            <form method="POST" action="/convenios" enctype="multipart/form-data">

                {{ csrf_field() }}
                <div class="card-body">
                    <div class="formgroup" class="col-lg-6">
                        <label for="id">Id:</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="formgroup" width="100">
                        <label for="sede">Sede:</label>
                        <select id="sede" name="sede" class="form-control">
                            @if (empty($sede))
                                @foreach($sedes as $sede)
                                    <option value="{{ (string)$sede->idsede }}">{{ $sede->nombresede }}</option>
                                @endforeach
                            @else
                                @foreach($sedes as $sed)
                                    <option value="{{ $sed->idsede }}"
                                            @if($sed->idsede == $sede->idsede)
                                            selected
                                            @endif
                                    >{{ $sed->nombresede }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="formgroup" width="100">
                        <label for="empresa">Empresa:</label>
                        <select id="empresa" name="empresa" class="form-control">
                            @if (empty($empresa))
                                @foreach($empresas as $empresa)
                                    <option value="{{ (string)$empresa->idempresa }}">{{ $empresa->nombreempresa }}</option>
                                @endforeach
                            @else
                                @foreach($empresas as $emp)
                                    <option value="{{ $emp->idempresa }}"
                                            @if($emp->idempresa == $empresa->idempresa)
                                            selected
                                            @endif
                                    >{{ $emp->nombreempresa }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="formgroup">
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                    </div>
                    <div class="col-lg-6" width="100">
                        <label for="inicio">Fecha de Inicio:</label>
                        <input type="date" class="form-control" id="inicio" name="inicio">
                    </div>
                    <div class="col-lg-6" width="100">
                        <label for="fin">Fecha de Fin:</label>
                        <input type="date" class="form-control" id="fin" name="fin">
                    </div>
                    <div class="form-group">
                        <label for="archivo">Archivo de Convenio:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="" id="archivo" name="archivo">
                                <label class="" for="archivo"></label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>

            </form>
            </div>

            </div>
        </div>
    </div>
@stop