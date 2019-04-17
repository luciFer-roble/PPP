@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Detalles de la practica</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/practicas">Practicas</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-7">
                <div class="card">
                {{Form::open( ['method'=>"PUT", 'url'=>array("/practicas", $practica->idpractica)]) }}

                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">

                            <label class="col-sm-10 control-label" for="estudiante">Estudiante:</label>
                            <div class="col-lg-12">
                            <select id="estudiante" name="estudiante" class="form-control">
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->idestudiante }}"
                                            @if($estudiante->idestudiante == $practica->idestudiante)
                                            selected
                                            @endif
                                    >{{ ($estudiante->nombresestudiante).' '.($estudiante->apellidosestudiante) }}</option>
                                @endforeach
                            </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="tutore">Empresa(Tutor Empresarial):</label>

                                <div class="col-lg-12">
                                    <div class="input-group mb-3">
                                        <select id="tutore" name="tutore" class="form-control">
                                            @foreach($tutores as $tutore)
                                                <option value="{{ $tutore->idtutore }}"
                                                        @if($tutore->idtutore == $practica->idtutore)
                                                        selected
                                                        @endif
                                                >{{ $tutore->empresa->nombreempresa.'('.$tutore->nombretutore .' '. $tutore->apellidotutore.')' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="profesor">Tutor Academico:</label>
                            <div class="col-lg-12">
                            <select id="profesor" name="profesor" class="form-control">
                                @foreach($profesores as $profesor)
                                    <option value="{{ $profesor->idprofesor }}"
                                            @if($profesor->idprofesor == $practica->idprofesor)
                                            selected
                                            @endif
                                    >{{ $profesor->nombresprofesor .' '. $profesor->apellidosprofesor }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-sm-10 control-label" for="tipo">Tipo:</label>
                            <div class="col-lg-12">
                            <select id="tipo" name="tipo" class="form-control">
                                <option value="Practica"
                                        @if("Practica" == $practica->tipopractica)
                                        selected
                                        @endif
                                >Practica Pre-Profesional</option>
                                <option value="Pasantia"
                                        @if("Pasantia" == $practica->tipopractica)
                                        selected
                                        @endif
                                >Pasantia</option>
                                <option value="Ayudantia"
                                        @if("Ayudantia" == $practica->tipopractica)
                                        selected
                                        @endif
                                >Ayudantia</option>
                                <option value="Proyecto"
                                        @if("Proyecto" == $practica->tipopractica)
                                        selected
                                        @endif
                                >Proyecto</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-10 control-label" for="salario">Sueldo/salario:</label>
                            <div class="col-lg-12">
                            <input type="text" class="form-control" id="salario" name="salario" value="{{ $practica->salariopractica }}">

                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-sm-10 control-label" for="inicio">Fecha de Inicio:</label>
                            <div class="col-lg-12">
                                <input type="date" class="form-control" id="inicio" name="inicio" value="{{ $practica->fechainiciopractica }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-10 control-label" for="fin">Fecha de Finalizaci&oacute;n:</label>
                            <div class="col-lg-12">
                                <input type="date" class="form-control" id="fin" name="fin" value="{{ $practica->fechafinpractica }}">
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-sm-10 control-label" for="periodo">Periodo Acad&eacute;mico:</label>
                            <div class="col-lg-12">
                                <select id="periodo" name="periodo" class="form-control">
                                    @foreach($periodos as $periodo)
                                        <option value="{{ $periodo->idperiodoacademico }}"
                                                @if($periodo->idperiodoacademico == $practica->idperiodoacademico)
                                                selected
                                                @endif
                                        >{{ $periodo->nombreperiodoacademico }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-10 control-label" for="nivel">Nivel:</label>
                            <div class="col-lg-12">
                                <select id="nivel" name="nivel" class="form-control">
                                    @foreach($niveles as $nivel)
                                        <option value="{{ $nivel->idnivel }}"
                                                @if($nivel->idnivel == $practica->idnivel)
                                                selected
                                                @endif
                                        >{{ $nivel->nombrenivel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-sm-10 control-label" for="horas">Horas:</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="horas" name="horas" value="{{ $practica->horaspractica }}">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-10 control-label" for="horas">Horario:</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="horario" name="horario" value="{{ $practica->horariopractica }}">

                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="descripcion">Descripci&oacute;n:</label>
                            <div class="col-md-12">
                            <textarea  class="form-control" id="descripcion" name="descripcion" >{{ $practica->descripcionpractica }}</textarea>
                        </div>
                        </div>

                    </div>
                    <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>


                        </div>
                    {{Form::close()}}

                    </div>

                </div>

            {{--<div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Opciones</h3>
                    </div>
                    <div class="form-horizontal">

                        <div class="card-body">
                            <div class="form-group">
                            <div class="col-5" >
                                <span >
                                     <a href="/actividades/{{ $practica->idpractica .'/list'}}"  class="btn btn-info btn-lg btn-block">SEGUIMIENTO</a>
                                </span>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-5">
                                <span >
                                <a href="/documentos/{{ $practica->idpractica .'/list'}}"  class="btn btn-info btn-lg btn-block">DOCUMENTOS</a></span>
                                </div>
                            </div>
                            @if(!(Auth::user()->hasRole('tut')) or !(Auth::user()->hasRole('prof')) )
                            <div class="form-group">
                                <div class="col-5">
                                    <button  data-toggle="modal" data-target="#f1" class="btn btn-danger btn-lg btn-block">FINALIZAR</button>
                                </div>
                            </div>
                                @endif
                        </div>

                    </div>
                </div>
            </div>--}}
            </div>


            </div>
@stop