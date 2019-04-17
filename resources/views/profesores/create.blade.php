@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Profesor</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/profesores">Profesores</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                <form method="POST" action="/profesores">

                    {{ csrf_field() }}
                    <div class="card-body">
                            <div class="form-group">
                                <label for="id">Id:</label>
                                <input type="text" class="form-control" id="id" name="id">
                            </div>
                        <div class="form-group">
                                    <label for="cedula">Cedula:</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula">
                                </div>
                        <div class="form-group">
                                <label for="escuela">Escuela:</label>
                                <select id="escuela" name="escuela" class="form-control">
                                    @foreach($escuelas as $escuela)
                                        <option value="{{ $escuela->idescuela }}">{{ $escuela->nombreescuela }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres">
                            </div>

                        <div class="form-group">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos">
                            </div>

                        <div class="form-group">
                                <label for="oficina">Oficina:</label>
                                <input type="text" class="form-control" id="oficina" name="oficina" width="50%">
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