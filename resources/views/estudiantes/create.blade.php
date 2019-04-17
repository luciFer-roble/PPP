@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Estudiante</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/estudiantes">Estudiantes</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="POST" action="/estudiantes" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row margin">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cedula">Cedula:</label>
                                        <input type="text" class="form-control" id="cedula" name="cedula">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombres">Nombres:</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos:</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="fechanacimiento">Fecha de Nacimiento:</label>
                                            <input type="date" class="form-control" id="fechanacimiento"
                                                   name="fechanacimiento">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="genero">Genero:</label>
                                            <select id="genero" name="genero" class="form-control">
                                                <option value="0">Masculino</option>
                                                <option value="1">Femenino</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="celular">Numero de celular:</label>
                                        <input type="text" class="form-control" id="celular" name="celular">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo electronico:</label>
                                        <input type="email" class="form-control" id="correo" name="correo">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="carrera">Carrera:</label>
                                        <select id="carrera" name="carrera" class="form-control">
                                            @foreach($carreras as $carrera)
                                                <option value="{{ $carrera->idcarrera }}">{{ $carrera->nombrecarrera }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo">Modalidad:</label>
                                        <select id="tipo" name="tipo" class="form-control">
                                            <option value="regular">Regular</option>
                                            <option value="semi">Semi-Presencial</option>
                                            <option value="distancia">Distancia</option>
                                        </select>
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