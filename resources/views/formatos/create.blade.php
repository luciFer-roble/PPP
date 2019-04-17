@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Formato</h1>
    @endsection
@section('nav')
<li class="breadcrumb-item"><a href="/">Inicio</a></li>
<li class="breadcrumb-item"><a href="/formatos">Formatos</a></li>
<li class="breadcrumb-item active">Nuevo</li>
    @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
            <form method="POST" action="/formatos" enctype="multipart/form-data">

                {{ csrf_field() }}
                <div class="card-body">
                    <div class="formgroup" class="col-lg-6">
                        <label for="id">Id:</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>

                    <div class="formgroup">
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                    </div>
                    <div class="form-group">
                        <label for="archivo">Archivo de Formato:</label>
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