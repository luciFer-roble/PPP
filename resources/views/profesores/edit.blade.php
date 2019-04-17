@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Profesor</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/profesores">Profesores</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">

                    {{Form::open( ['method'=>"PUT", 'url'=>array("/profesores", $profesor->idprofesor)]) }}

                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id">Id:</label>
                            <input type="text" class="form-control" id="id" name="id"
                                   value="{{ $profesor->idprofesor }}">
                        </div>
                        <div class="form-group">
                            <label for="escuela">Escuela:</label>
                            <select id="escuela" name="escuela" class="form-control">
                                @foreach($escuelas as $escuela)
                                    <option value="{{ $escuela->idescuela }}"
                                            @if($escuela->idescuela == $profesor->idescuela)
                                            selected
                                            @endif
                                    >{{ $escuela->nombreescuela }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombres">Nombres:</label>
                            <input type="text" class="form-control" id="nombres" name="nombres"
                                   value="{{ $profesor->nombresprofesor }}">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                                   value="{{ $profesor->apellidosprofesor }}">
                        </div>
                        <div class="formgroup" >
                            <label for="correo">Correo:</label>
                            <input type="text" class="form-control" id="correo" name="correo"
                                   value="{{ $profesor->correoprofesor }}">
                        </div>
                        <div class="formgroup" >
                            <label for="celular">Celular:</label>
                            <input type="text" class="form-control" id="celular" name="celular"
                                   value="{{ $profesor->celularprofesor }}">
                        </div>
                        <div class="formgroup" >
                            <label for="oficina">Oficina:</label>
                            <input type="text" class="form-control" id="oficina" name="oficina"
                                   value="{{ $profesor->oficinaprofesor }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>

                        </div>
                    </div>

                    {{Form::close()}}

                </div>
            </div>
        </div>

    </div>
@stop