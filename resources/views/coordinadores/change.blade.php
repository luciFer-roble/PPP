@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Cambiar Coordinador de Carrera</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/coordinadores">Coordinadores</a></li>
    <li class="breadcrumb-item active">Cambiar</li>
@endsection
@section('content')

        <div class="container-fluid">
        <div class="row">
            <div class="col-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Coordinador Actual</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 25%">Carrera:</th>
                            <td colspan="3"> {{ $coordinador->carrera->nombrecarrera }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%">Nombre:</th>
                            <td colspan="3">{{ $coordinador->profesor->nombresprofesor }} {{ $coordinador->profesor->apellidosprofesor }}</td>

                        </tr>
                        <tr>
                            <th style="width: 25%">Fecha de Inicio:</th>
                            <td colspan="3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input id="inicio" name="inicio" type="date" class="form-control" value="{{ $coordinador->fechainiciocoordinador }}" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <th style="width: 25%" >Fecha de Fin:</th>

                            <td colspan="3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input id="fin" name="fin" type="date" class="form-control" value="{{ $coordinador->fechafincoordinador }}" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                </div>
                            </td>


                        </tr>

                    </table>
                </div>
                <div class="card-footer">
                    <button  style="vertical-align: middle" data-toggle="modal" data-target="#f1" class="btn btn-outline-danger float-right">Finalizar</button>

                </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="f1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ingreso de Nuevo Coordinador</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="/coordinadores">

                            {{ csrf_field() }}
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th for="carrera">Carrera</th>
                                        <td colspan="2">
                                            <input type="text" class="form-control" id="nombrecarrera" name="nombrecarrera" value="{{ $coordinador->carrera->nombrecarrera }}"disabled>
                                        </td>
                                        <input type="hidden" class="form-control" id="carrera" name="carrera" value="{{ $coordinador->carrera->idcarrera }}">
                                        <input  type="hidden" class="form-control" id="cambio" name="cambio" value="{{$coordinador->idcoordinador}}">
                                        <input  type="hidden" class="form-control" id="activo" name="activo" value="FALSE">

                                    </tr>
                                    <tr>
                                        <th for="profesor">Profesor</th>
                                        <td colspan="2"><select id="profesor" name="profesor" class="form-control select2" style="width: 100%;" >
                                                @if (empty($profesor))
                                                    @foreach($profesores as $profesor)
                                                        <option value="{{ (string)$profesor->idprofesor }}">{{ $profesor->nombresprofesor }} {{ $profesor->apellidosprofesor }} </option>
                                                    @endforeach
                                                @else
                                                    @foreach($profesores as $prof)
                                                        <option value="{{ $prof->idprofesor }}"
                                                                @if($prof->idprofesor == $profesor->idprofesor)
                                                                selected
                                                                @endif
                                                        >{{ $prof->nombresprofesor }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th for="inicio">Fecha de Inicio</th>
                                        <td colspan="2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="date" class="form-control"id="inicio" name="inicio" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th for="fin">Fecha de Fin</th>
                                        <td colspan="2">
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

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{--<div class="row">
            <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Nuevo Coordinador</h3>
                </div>
                <form method="POST" action="/coordinadores">

                    {{ csrf_field() }}
                        <div class="card-body">
                            <table class="table table-bordered">
                            <tr>
                                <th for="carrera">Carrera</th>
                                <td colspan="2">
                                    <input type="text" class="form-control" id="nombrecarrera" name="nombrecarrera" value="{{ $coordinador->carrera->nombrecarrera }}"disabled>
                                </td>
                                <input type="hidden" class="form-control" id="carrera" name="carrera" value="{{ $coordinador->carrera->idcarrera }}">

                            </tr>
                            <tr>
                                <th for="profesor">Profesor</th>
                                <td colspan="2"><select id="profesor" name="profesor" class="form-control select2" style="width: 100%;" >
                                        @if (empty($profesor))
                                            @foreach($profesores as $profesor)
                                                <option value="{{ (string)$profesor->idprofesor }}">{{ $profesor->nombresprofesor }} {{ $profesor->nombre2profesor }} {{ $profesor->apellido1profesor }} {{ $profesor->apellido2profesor }}</option>
                                            @endforeach
                                        @else
                                            @foreach($profesores as $prof)
                                                <option value="{{ $prof->idprofesor }}"
                                                        @if($prof->idprofesor == $profesor->idprofesor)
                                                        selected
                                                        @endif
                                                >{{ $prof->nombresprofesor }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th for="inicio">Fecha de Inicio</th>
                                <td colspan="2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control"id="inicio" name="inicio" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th for="fin">Fecha de Fin</th>
                                <td colspan="2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input id="fin" name="fin" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                    </div>
                                </td>
                            </tr>
                    </table>
                        </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>

                        </div>
                    </div>
                </form>
            </div>
            </div>
            </div>--}}

        </div>

@stop