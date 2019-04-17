@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/practicas">Practicas</a></li>
    <li class="breadcrumb-item active">Detalle</li>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-0"></div>
            <div class="col-md-4 card">
                <div class="row card-header">
                    <span class="text-dark"><h4>Centro de Practicas</h4></span>
                </div>
                <div class="row card-body p-0 m-0">
                    <div class="col-md-5">
                        <span class="text-info btn p-0 m-0 border-0"><label>Nombre:</label></span>
                    </div>
                    <div class="col-md-7">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->tutore->empresa->nombreempresa }}</label>
                    </div>
                </div>
                <div class="row card-body p-0 m-0">
                    <div class="col-md-5">
                        <span class="text-info btn p-0 m-0 border-0"><label>Tipo de institucion:</label></span>
                    </div>
                    <div class="col-md-7">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->tutore->empresa->tipoempresa }}</label>
                    </div>
                </div>
                <div class="row card-body p-0 m-0">
                    <div class="col-md-5">
                        <span class="text-info btn p-0 m-0 border-0"><label>Sector economico:</label></span>
                    </div>
                    <div class="col-md-7">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->tutore->empresa->sectorempresa }}</label>
                    </div>
                </div>
                <div class="row card-body p-0 m-0 border-0">
                    <div class="col-md-5">
                        <span class="text-info btn p-0 m-0 border-0"><label>Tutor empresarial:</label></span>
                    </div>
                    <div class="col-md-7">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->tutore->nombretutore.' '.$practica->tutore->apellidotutore }}</label>
                    </div>
                </div>
                <div class="row card-body p-0 m-0 border-0">
                    <div class="col-md-5">
                        <span class="text-info btn p-0 m-0 border-0"><label>telefono: </label></span>
                    </div>
                    <div class="col-md-7">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->tutore->celulartutore }}</label>
                    </div>
                </div>
                <div class="row card-body p-0 m-0 border-0">
                    <div class="col-md-5">
                        <span class="text-info btn p-0 m-0 border-0"><label>correo:</label></span>
                    </div>
                    <div class="col-md-7">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->tutore->correotutore }}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-0"></div>
            <div class="col-md-8 card">
                <div class="row card-header">
                    <span class="text-dark"><h4>Datos del Estudiante</h4></span>
                </div>
                <div class="row card-body p-0 m-0">
                    <div class="col-md-3">
                        <span class="text-info btn p-0 m-0 border-0"><label>Nombre:</label></span>
                    </div>
                    <div class="col-md-4">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->estudiante->nombresestudiante.' '.$practica->estudiante->apellidosestudiante }}</label>
                    </div>
                    <div class="col-md-2">
                        <span class="text-info btn p-0 m-0 border-0"><label>Nivel:</label></span>
                    </div>
                    <div class="col-md-3">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->nivel->nombrenivel }}</label>
                    </div>
                </div>
                <div class="row card-body p-0 m-0">
                    <div class="col-md-3">
                        <span class="text-info btn p-0 m-0 border-0"><label>Identificacion:</label></span>
                    </div>
                    <div class="col-md-4">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->estudiante->cedulaestudiante }}</label>
                    </div>
                    <div class="col-md-2">
                        <span class="text-info btn p-0 m-0 border-0"><label>Tipo:</label></span>
                    </div>
                    <div class="col-md-3">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->estudiante->tipoestudiante }}</label>
                    </div>
                </div>
                <div class="row card-body p-0 m-0">
                    <div class="col-md-3">
                        <span class="text-info btn p-0 m-0 border-0"><label>Unidad Academica:</label></span>
                    </div>
                    <div class="col-md-4">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->estudiante->carrera->escuela->facultad->nombrefacultad }}</label>
                    </div>
                    <div class="col-md-2">
                        <span class="text-info btn p-0 m-0 border-0"><label>Celular:</label></span>
                    </div>
                    <div class="col-md-3">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->estudiante->celularestudiante }}</label>
                    </div>
                </div>
                <div class="row card-body p-0 m-0 border-0">
                    <div class="col-md-3">
                        <span class="text-info btn p-0 m-0 border-0"><label>Carrera:</label></span>
                    </div>
                    <div class="col-md-3">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->estudiante->carrera->nombrecarrera }}</label>
                    </div>
                </div>
                <div class="row card-body p-0 m-0 border-0">
                    <div class="col-md-3">
                        <span class="text-info btn p-0 m-0 border-0"><label>E-mail:</label></span>
                    </div>
                    <div class="col-md-3">
                        <label class="btn p-0 m-0 border-0 text-secondary">{{ $practica->estudiante->correoestudiante }}</label>
                    </div>
                </div>
                <div class="row card-body p-0 m-0 border-0">

                    <div class="col-md-3">
                        <span class="text-info btn p-0 m-0 border-0"><label></label></span>
                    </div>
                    <div class="col-md-3">
                        <label class="btn p-0 m-0 border-0 text-secondary"></label>
                    </div>
                </div>
            </div>
            <div class="col-md-0"></div>

        </div>
        <div class="row">
            <div class="col-md-0"></div>
            <div class="col-md-9 card">
                {{Form::open( ['method'=>"PUT", 'url'=>array("/practicas", $practica->idpractica)]) }}

                {{ csrf_field() }}
                <div class="card-header">
                    <h5>Detalle de la Práctica</h5>
                </div>
                <div class="row card-body p-1 m-1 border-0">
                    <div class="form-group p-0 m-0 col-md-6">
                        <label class="col-sm-12 control-label" for="profesor">Tutor Academico:</label>
                        <div class="col-lg-12">
                            <select style="background-color: white !important;" id="profesor" name="profesor"
                                    class="form-control"
                            @if((Auth::user()->hasRole('tut')) or (Auth::user()->hasRole('prof')) )
                                {{ ' disabled ' }}
                                    @endif
                            >
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

                    <div class="form-group  p-0 m-0 col-md-6">
                        <label class="col-sm-12 control-label" for="periodo">Periodo Academico:</label>
                        <div class="col-lg-12">
                            <select style="background-color: white !important;" id="periodo" name="periodo"
                                    class="form-control"
                            @if((Auth::user()->hasRole('tut')) or (Auth::user()->hasRole('prof')) )
                                {{ ' disabled ' }}
                                    @endif
                            >
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

                </div>
                <div class="row card-body p-1 m-1 border-0">
                    <div class="form-group p-0 m-0 col-md-6">
                        <label class="col-sm-12 control-label" for="inicio">Fecha de Inicio:</label>
                        <div class="col-lg-12">
                            <input style="background-color: white !important;" type="date" class="form-control"
                                   id="inicio" name="inicio"
                                   @if((Auth::user()->hasRole('tut')) or (Auth::user()->hasRole('prof')) )
                                   {{ ' disabled ' }}
                                   @endif
                                   value="{{ $practica->fechainiciopractica }}">
                        </div>
                    </div>
                    <div class="form-group p-0 m-0 col-md-6">
                        <label class="col-sm-12 control-label" for="fin">Fecha de Finalizacion:</label>
                        <div class="col-lg-12">
                            <input style="background-color: white !important;" type="date" class="form-control" id="fin"
                                   name="fin"
                                   @if((Auth::user()->hasRole('tut')) or (Auth::user()->hasRole('prof')) )
                                   {{ ' disabled ' }}
                                   @endif
                                   value="{{ $practica->fechafinpractica }}">
                        </div>
                    </div>
                </div>

                <div class="row card-body p-1 m-1 border-0">
                    <div class="form-group p-0 m-0 col-md-3">
                        <label class="col-sm-12 control-label" for="tipo">Tipo:</label>
                        <div class="col-lg-12">
                            <select style="background-color: white !important;" id="tipo" name="tipo"
                                    class="form-control"
                            @if((Auth::user()->hasRole('tut')) or (Auth::user()->hasRole('prof')) )
                                {{ ' disabled ' }}
                                    @endif
                            >
                                <option value="Practica"
                                        @if("Practica" == $practica->tipopractica)
                                        selected
                                        @endif
                                >Practica Pre-Profesional
                                </option>
                                <option value="Pasantia"
                                        @if("Pasantia" == $practica->tipopractica)
                                        selected
                                        @endif
                                >Pasantia
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group p-0 m-0 col-md-3">
                        <label class="col-sm-12 control-label" for="salario">Sueldo/salario:</label>
                        <div class="col-lg-12">
                            <input style="background-color: white !important;" type="text" class="form-control"
                                   id="salario" name="salario"
                                   @if((Auth::user()->hasRole('tut')) or (Auth::user()->hasRole('prof')) )
                                   {{ ' disabled ' }}
                                   @endif
                                   value="{{ $practica->salariopractica }}">

                        </div>
                    </div>


                    <div class="form-group p-0 m-0 col-md-1">
                        <label class="col-sm-12 control-label" for="horas">Horas</label>
                        <div class="col-lg-12">
                            <input style="background-color: white !important;" type="text" class="form-control"
                                   id="horas" name="horas"
                                   @if((Auth::user()->hasRole('tut')) or (Auth::user()->hasRole('prof')) )
                                   {{ ' disabled ' }}
                                   @endif
                                   value="{{ $practica->horaspractica }}">

                        </div>
                    </div>
                    <div class="form-group p-0 m-0 col-md-5">
                        <label class="col-sm-12 control-label" for="horario">Horario:</label>
                        <div class="col-lg-12">
                            <input style="background-color: white !important;" type="text" class="form-control"
                                   id="horario" name="horario"
                                   @if((Auth::user()->hasRole('tut')) or (Auth::user()->hasRole('prof')) )
                                   {{ ' disabled ' }}
                                   @endif
                                   value="{{ $practica->horariopractica }}">

                        </div>
                    </div>
                </div>

                <div class="row card-body p-1 m-1 border-0">
                    <div class="form-group p-0 m-0 col-md-12">
                        <label class="col-sm-12 control-label" for="descripcion">Descripcion:</label>
                        <div class="col-lg-12">
                            <textarea style="background-color: white !important;" class="form-control" id="descripcion"
                                      name="descripcion"
                            @if((Auth::user()->hasRole('tut')) or (Auth::user()->hasRole('prof')) )
                                {{ ' disabled ' }}
                                    @endif
                            >{{ $practica->descripcionpractica }}</textarea>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" id="nivel" name="nivel" value="{{ $practica->idnivel }}"/>
                        <input type="hidden" id="estudiante" name="estudiante" value="{{ $practica->idestudiante }}"/>
                        <input type="hidden" id="tutore" name="tutore" value="{{ $practica->idtutore }}"/>
                    </div>

                </div>
                @if((Auth::user()->hasRole('coord')) or (Auth::user()->hasRole('est')) )
                <div class="card-footer">
                    <button type="submit" class="btn btn-lg btn-primary">
                        Actualizar
                    </button>

                        <button data-toggle="modal" data-target="#f1" class="btn  btn-lg btn-danger float-right">
                            Finalizar
                        </button>
                </div>
                @endif
                {{Form::close()}}
            </div>
            <div class="col-md-0"></div>
            <div class="col-md-3 card pt-2" id="app">
                <dona-item :practica="{{ $practica }}" suma="{{ $totalhoras }}"
                           docs="{{ count($practica->documentop) }}"></dona-item>
            </div>
            <div class="col-md-0"></div>

        </div>
        <div class="modal fade" id="f1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

             aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ingreso de Nuevo Coordinador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open( ['method'=>"PUT", 'url'=>array("/practicas/".$practica->idpractica."/finalize")]) }}

                    {{ csrf_field() }}
                    <div class="card-body">
                        Se registraran {{$totalhoras}} horas.<BR>
                        Desea continuar?
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Si</button>
                        <a class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop