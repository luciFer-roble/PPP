@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Tutor</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/tutores">Tutores</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
            {{Form::open( ['method'=>"PUT", 'url'=>array("/tutores", $tutore->idtutore)]) }}

            {{ csrf_field() }}

                <div class="card-body">
                    <div class="formgroup" width="100">
                        <label for="empresa">Empresa:</label>
                        <select id="empresa" name="empresa" class="form-control">
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->idempresa }}"
                                        @if($empresa->idempresa == $tutore->idempresa)
                                        selected
                                        @endif
                                >{{ $empresa->nombreempresa }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="formgroup" width="100">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $tutore->nombretutore }}">
                    </div>

                    <div class="formgroup">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $tutore->apellidotutore }}">
                    </div>

                    <div class="formgroup">
                        <label for="celular">Celular:</label>
                        <input type="text" class="form-control" id="celular" name="celular" value="{{ $tutore->celulartutore }}">
                    </div>

                    <div class="formgroup">
                        <label for="correo">Correo:</label>
                        <input type="text" class="form-control" id="correo" name="correo" value="{{ $tutore->correotutore }}">
                    </div>
                </div>
                    <div class="card-footer">

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>


            </form>
            </div>

            </div>
        </div>
        </div>
    </div>
@stop