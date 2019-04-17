@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Coordinador</h1>
    @endsection
@section('nav')
<li class="breadcrumb-item"><a href="/">Inicio</a></li>
<li class="breadcrumb-item"><a href="/coordinadores">Coordinadores</a></li>
<li class="breadcrumb-item active">Nuevo</li>
@endsection
@section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nuevo Coordinador</h3>
                        </div>
                        <form method="POST" action="/coordinadores">

                                {{ csrf_field() }}
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th for="carrera">Carrera:</th>
                                            <td>
                                                <select id="carrera" name="carrera" class="form-control select2" style="width: 100%;" >
                                                    @if (empty($carrera))
                                                        @foreach($carreras as $carrera)
                                                            <option value="{{ (string)$carrera->idcarrera }}">{{ $carrera->nombrecarrera }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($carreras as $car)
                                                            <option value="{{ $car->idcarrera }}"
                                                                    @if($car->idcarrera == $carrera->idcarrera)
                                                                    selected
                                                                    @endif
                                                            >{{ $car->nombrecarrera }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>

                                        </tr>
                                        <tr>
                                            <th for="profesor">Profesor:</th>
                                            <td><select id="profesor" name="profesor" class="form-control select2" style="width: 100%;" >
                                                    @if (empty($profesor))
                                                        @foreach($profesores as $profesor)
                                                            <option value="{{ (string)$profesor->idprofesor }}">
                                                                {{ $profesor->nombresprofesor }} {{ $profesor->apellidosprofesor }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        @foreach($profesores as $prof)
                                                            <option value="{{ $prof->idprofesor }}"
                                                                    @if($prof->idprofesor == $profesor->idprofesor)
                                                                    selected
                                                                    @endif
                                                            >{{ $prof->nombre1profesor }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th for="inicio">Fecha de Inicio:</th>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control"id="inicio" name="inicio" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th for="fin">Fecha de Fin:</th>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input id="fin" name="fin" type="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="activo" name="activo" value="true">
                                        <button type="submit" class="btn btn-primary">Guardar</button>

                                    </div>
                                </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

@stop