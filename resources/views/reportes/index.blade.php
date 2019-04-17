@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Reportes</li>
@endsection

@section('content')

    <div class="container-fluid">
        <!-- Breadcrumbs-->

        @if(Auth::user()->hasRole('coord') )
                <div class="row">
                    <!-- small card -->
                    <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r1">
                        <div class="small-box col-lf-4" style="background-color: #ffdd93">
                            <div class="inner row">
                                <div class="col-md-12"><h3 class="text-secondary">Practicas Finalizadas</h3></div></div>
                            <div class="inner row">
                                <div class="col-md-9">
                                    <p>Reporte que muestra los estudiantes que finalizaron sus pr&aacute;cticas en un periodo acad&eacute;mico especifico</p>
                                </div>
                                <div class="col-md-3 icon" style="vertical-align: middle">
                                    <i style="padding-top: 80%"  class="fa fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r2">
                    <div class="small-box col-lf-4" style="background-color: #58dada">
                        <div class="inner row">
                            <div class="col-md-12"><h3 class="text-secondary">Periodo Acad&eacute;mico</h3></div></div>
                        <div class="inner row">
                            <div class="col-md-9">
                                <p>Reporte que muestra las un listado de prácticas agrupadas por el periodo académico en el estudiante registró la misma</p>
                            </div>
                            <div class="col-md-3 icon" style="vertical-align: middle">
                                <i style="padding-top: 80%"  class="fa fa-chart-line"></i>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r3">
                    <div class="small-box  col-lf-4" style="background-color: #1ca2bb">
                        <div class="inner row">
                            <div class="col-md-12"><h3 class="text-secondary">Tipo de Proyecto</h3></div></div>
                        <div class="inner row">
                            <div class="col-md-9">
                                <p>Reporte que muestra las prácticas agrupadas por tipo de proyecto(Pasantías, Prácticas pre Profesionales, Ayudantias y Proyectos)</p>
                            </div>
                            <div class="col-md-3 icon" style="vertical-align: middle">
                                <i style="padding-top: 80%"  class="fa fa-bar-chart-o"></i>
                            </div>
                        </div>
                    </div>

                </div>
                </div>

                <div class="row">
                    <!-- small card -->
                    <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r4">
                    <div class="small-box col-lf-4" style="background-color: #1fffff">
                        <div class="inner row">
                            <div class="col-md-12"><h3 class="text-secondary">Tipo de Empresa</h3></div></div>
                        <div class="inner row">
                            <div class="col-md-9">
                                <p>Reporte que muestra las prácticas agrupadas por tipo de empresa en el que realizan(Pública, Privada, Organismo Internacional, etcétera)</p>
                            </div>
                            <div class="col-md-3 icon" style="vertical-align: middle">
                                <i style="padding-top: 80%"  class="fa fa-file-contract"></i>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r5">
                    <div class="small-box col-lf-4" style="background-color: #ff9d76">
                        <div class="inner row">
                            <div class="col-md-12"><h3 class="text-secondary">Sector Empresarial</h3></div></div>
                        <div class="inner row">
                            <div class="col-md-9">
                                <p>Reporte que muestra las prácticas agrupadas por el sector de la empresa en el que realizan(Primario, Secundario, Terciario)</p>
                            </div>
                            <div class="col-md-3 icon" style="vertical-align: middle">
                                <i style="padding-top: 80%"  class="fa fa-chart-area"></i>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r6">
                    <div class="small-box col-lf-4" style="background-color: #ff4273">
                        <div class="inner row">
                            <div class="col-md-12"><h3 class="text-secondary">Nivel Académico</h3></div></div>
                        <div class="inner row">
                            <div class="col-md-9">
                                <p>Reporte que muestra las prácticas por el nivel en el que se encontraba el estudiante mientras realizó la misma</p>
                            </div>
                            <div class="col-md-3 icon" style="vertical-align: middle">
                                <i style="padding-top: 80%"  class="fa fa-pie-chart"></i>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r11">
                        <div class="small-box col-lf-4" style="background-color: #80bdff">
                            <div class="inner row">
                                <div class="col-md-12"><h3 class="text-secondary">Tutor Académico</h3></div></div>
                            <div class="inner row">
                                <div class="col-md-9">
                                    <p>Reporte que muestra los estudiantes que estan bajo la tutoria académica de un profesor seleccionado</p>
                                </div>
                                <div class="col-md-3 icon" style="vertical-align: middle">
                                    <i style="padding-top: 80%"  class="fa fa-pie-chart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
        @if(Auth::user()->hasRole('est'))
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r7">
                <div class="small-box col-lf-4" style="background-color: #1fffff">
                    <div class="inner row">
                        <div class="col-md-12"><h3 class="text-secondary">Registro Base de Datos</h3></div></div>
                    <div class="inner row">
                        <div class="col-md-9">
                            <p>Documento de registro de base de Datos de cada estudiante</p>
                        </div>
                        <div class="col-md-3 icon" style="vertical-align: middle">
                            <i style="padding-top: 70%"  class="fa fa-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r8">
                <div class="small-box col-lf-4" style="background-color: #ff9d76">
                    <div class="inner row">
                        <div class="col-md-12"><h3 class="text-secondary">Lineas de Formación</h3></div></div>
                    <div class="inner row">
                        <div class="col-md-9">
                            <p>Documento de ingreso de las lineas de Formación</p>
                        </div>
                        <div class="col-md-3 icon" style="vertical-align: middle">
                            <i style="padding-top: 70%"  class="fa fa-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
        @if(Auth::user()->hasRole('prof'))
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r9">
                <div class="small-box col-lf-4" style="background-color: #D3BFF2">
                    <div class="inner row">
                        <div class="col-md-12"><h3 class="text-secondary">Actividades del Docente</h3></div></div>
                    <div class="inner row">
                        <div class="col-md-9">
                            <p>Reporte que muestra los estudiantes que estan bajo la tutoria académica de un profesor seleccionado y las actividades de ese profesor</p>
                    </div>
                        <div class="col-md-3 icon" style="vertical-align: middle">
                            <i style="padding-top: 80%"  class="fa fa-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-4" data-toggle="modal" data-target="#r10">
                <div class="small-box col-lf-4" style="background-color: #D291D6">
                    <div class="inner row">
                        <div class="col-md-12"><h3 class="text-secondary">Reporte de Seguimiento</h3></div></div>
                    <div class="inner row">
                        <div class="col-md-9">
                            <p>Reporte que muestra las practicas de un estudiante seleccionado y el formulario para su seguimiento</p>
                        </div>
                        <div class="col-md-3 icon" style="vertical-align: middle">
                            <i style="padding-top: 80%"  class="fa fa-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif

            </div>

    <!-- Modal reporte 1-->
    <div class="modal fade" id="r1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prácticas Finalizadas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r1">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-10 control-label" for="inicio">Periodo Académico</label>
                        <div class="col-lg-11">
                            <select id="periodor1" name="periodor1" class="form-control">
                                @foreach($periodos as $periodo)
                                    <option value="{{ $periodo->idperiodoacademico }}"
                                    >{{ $periodo->descripcionperiodoacademico  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Mostrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal reporte 2-->
    <div class="modal fade" id="r2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Periodo Académico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r2p">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio" style="color: white;">Periodo de Inicio</label>
                            <div class="col-lg-11">
                                <select id="periodor1" name="periodor1" class="form-control">
                                    @foreach($periodos as $periodo)
                                        <option value="{{ $periodo->idperiodoacademico }}"
                                        >{{ $periodo->descripcionperiodoacademico  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Mostrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Modal reporte 3-->
    <div class="modal fade" id="r3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tipo de Proyecto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r3p">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Tipo</label>
                            <div class="col-lg-11">
                                <select id="tipopractica" name="tipopractica" class="form-control">
                                    <option value="Pasantia">Pasantía</option>
                                    <option value="Practica">Práctica Pre Profesional</option>
                                    <option value="Proyecto">Proyecto</option>
                                    <option value="Ayudantia">Ayudantía</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Mostrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal reporte 4-->
    <div class="modal fade" id="r4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tipo de Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r4p">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Tipo</label>
                            <div class="col-lg-11">
                                <select id="tipoempresa" name="tipoempresa" class="form-control">
                                    <option value="Publica">Pública</option>
                                    <option value="Privada">Privada</option>
                                    <option value="Sin Fines de Lucro">Empresa Sin Fines de Lucro</option>
                                    <option value="Organismo Internacional">Organismo Internacional</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Mostrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal reporte 5-->
    <div class="modal fade" id="r5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sector de la Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r5p">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Sector</label>
                            <div class="col-lg-11">
                                <select id="sector" name="sector" class="form-control">
                                    <option value="Primario">Primario</option>
                                    <option value="Secundario">Secundario</option>
                                    <option value="Terciario">Terciario</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Mostrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal reporte 6-->
    <div class="modal fade" id="r6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nivel Académico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r6p">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Nivel</label>
                            <div class="col-lg-11">
                                <select id="nivel" name="nivel" class="form-control">
                                    @foreach($niveles as $nivel)
                                        <option value="{{ $nivel->idnivel }}"
                                        >{{ $nivel->nombrenivel  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Mostrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal reporte 7-->
    <div class="modal fade" id="r7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de base de datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r7">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Estudiante</label>
                            <div class="col-lg-11">
                                <select id="estudiante" name="estudiante" class="form-control">
                                    @foreach($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->idestudiante }}"
                                        >{{ $estudiante->nombresestudiante .' '.$estudiante->apellidosestudiante  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Mostrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal reporte 8-->
    <div class="modal fade" id="r8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Líneas de Formación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r8">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Estudiante</label>
                            <div class="col-lg-11">
                                <select id="estudiante" name="estudiante" class="form-control">
                                    @foreach($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->idestudiante }}"
                                        >{{ $estudiante->nombresestudiante .' '.$estudiante->apellidosestudiante  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Mostrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal reporte 9-->
    <div class="modal fade" id="r9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actividades del Docente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r9">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Profesor</label>
                            <div class="col-lg-11">
                                <select id="profesor" name="profesor" class="form-control">
                                    @foreach($profesores as $profesor)
                                        <option value="{{ $profesor->idprofesor }}"
                                        >{{ $profesor->nombresprofesor .' '.$profesor->apellidosprofesor  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Mostrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal reporte 10-->
    <div class="modal fade" id="r10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actividades del Estudiante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r10">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Estudiante</label>
                            <div class="col-lg-11">
                                <select id="estudiante" name="estudiante" class="form-control">
                                    @foreach($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->idestudiante }}"
                                        >{{ $estudiante->nombresestudiante .' '.$estudiante->apellidosestudiante  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Mostrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal reporte 9-->
    <div class="modal fade" id="r11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estudiantes por Tutor Academico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r11">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Profesor</label>
                            <div class="col-lg-11">
                                <select id="profesor" name="profesor" class="form-control">
                                    @foreach($profesores as $profesor)
                                        <option value="{{ $profesor->idprofesor }}"
                                        >{{ $profesor->nombresprofesor .' '.$profesor->apellidosprofesor  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Mostrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop