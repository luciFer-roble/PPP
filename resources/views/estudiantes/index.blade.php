@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Estudiantes</li>
@endsection

@section('content')

    <div class="container-fluid">
        <!-- Breadcrumbs-->

        <div class="row">
            <div class="col-12" >
                <!-- Example DataTables Card-->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">

                            <div class="btn-toolbar mb-2 mb-md-0">
                                <h1>ESTUDIANTES</h1></div>
                            @if(Auth::user()->hasRole('admin'))
                                <div class="btn-group mr-2">
                                    <input type="button" onClick="location.href = 'estudiantes/create'"
                                           class="btn btn-sm btn-outline-success" value="NUEVO">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body m-0">
                        <div class="table-responsive">

                            @if(Auth::user()->hasRole('admin'))
                                <table class="table table-bordered" style="table-layout: inherit">

                                    <tbody style="font-size: 12px">
                                    <tr>
                                        <th class="p-0 m-0">Cedula</th>
                                        <th class="p-0 m-0">Nombres</th>
                                        <th class="p-0 m-0">Apellidos</th>
                                        <th class="p-0 m-0">Tipo</th>
                                        <th class="p-0 m-0">Celular</th>
                                        <th class="p-0 m-0">Correo</th>
                                        <th class="p-0 m-0">Fecha de Nacimiento</th>
                                        <th class="p-0 m-0">Genero</th>
                                        <th class="p-0 m-0">Carrera</th>
                                        <td class="p-0 m-0"></td>


                                    </tr>


                                    @foreach($estudiantes as $estudiante)
                                        <tr>
                                            <td class="p-0 m-0">{{ $estudiante->cedulaestudiante }}</td>
                                            <td class="p-0 m-0">{{ $estudiante->nombresestudiante }}</td>
                                            <td class="p-0 m-0">{{ $estudiante->apellidosestudiante }}</td>
                                            <td class="p-0 m-0">{{ $estudiante->tipoestudiante }}</td>
                                            <td class="p-0 m-0">{{ $estudiante->celularestudiante }}</td>
                                            <td class="p-0 m-0">{{ $estudiante->correoestudiante }}</td>
                                            <td class="p-0 m-0">{{ $estudiante->fechanacimientoestudiante }}</td>
                                            <td align="center" class="p-0 m-0">@if($estudiante->generoestudiante=='1')
                                                    F
                                                @else M
                                                @endif</td>
                                            <td style="min-width: 100px"
                                                class="p-0 m-0">{{ $estudiante->carrera->nombrecarrera }}</td>

                                            <td class="p-0 m-0" style="width: 9%">
                                                <div class="row p-0 m-0">
                                                    <div class="col p-0 m-0" align="center">
                                                        <a class="btn btn-link p-0 m-0"
                                                           href="{{ URL::to('estudiantes/' . $estudiante->idestudiante . '/edit') }}">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col p-0 m-0" align="center">
                                                        {{ Form::open(array('url' => 'estudiantes/' . $estudiante->idestudiante, 'class' => '')) }}
                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        <button type="submit" class="btn btn-link p-0 m-0"><i
                                                                    class="fa fa-fw fa-trash-alt"
                                                                    style="color: #f10407"></i></button>
                                                        {{ Form::close() }}
                                                    </div>
                                                    <div class="col p-0 m-0" align="center">
                                                        <a title="Ver asignaturas" class="btn btn-link p-0 m-0"
                                                           href="{{ URL::to('estasignaturas/' . $estudiante->carrera->idcarrera . '/create/' . $estudiante->idestudiante) }}">

                                                            <i class="fa fa-fw fa-clipboard-list"></i></a>
                                                    </div>


                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                    <form method="POST" action="/estudiantes">
                                        {{ csrf_field() }}

                                        <tr>
                                            <td class="p-0 m-0"><input style="font-size: 10px; max-width: 90px "
                                                                       type="text" class="form-control" id="cedula"
                                                                       name="cedula"></td>
                                            <td class="p-0 m-0"><input style="font-size: 10px " type="text"
                                                                       class="form-control" id="nombres" name="nombres">
                                            </td>
                                            <td class="p-0 m-0"><input style="font-size: 10px " type="text"
                                                                       class="form-control" id="apellidos"
                                                                       name="apellidos"></td>
                                            <td class="p-0 m-0"><select style="font-size:10px; height: 10%" id="tipo"
                                                                        name="tipo" class="form-control">
                                                    <option value="0">Tipo</option>
                                                    <option value="regular">Regular</option>
                                                    <option value="semi">Semi-Presencial</option>
                                                    <option value="distancia">Distancia</option>
                                                </select></td>
                                            <td class="p-0 m-0"><input style="font-size: 10px; max-width: 90px "
                                                                       type="text" class="form-control" id="celular"
                                                                       name="celular"></td>
                                            <td class="p-0 m-0"><input style="font-size: 10px " type="text"
                                                                       class="form-control" id="correo" name="correo">
                                            </td>
                                            <td class="p-0 m-0"><input style="font-size: 10px; max-width: 100px "
                                                                       type="date" class="form-control"
                                                                       id="fechanacimiento" name="fechanacimiento"></td>
                                            <td class="p-0 m-0" style="vertical-align: middle;width: 5%">
                                                <fieldset class="p-0 m-0" style="font-size: 10px; height: 10% "
                                                          id="genero" name="genero" class="form-control">
                                                    <input type="radio" value="0" name="genero">M
                                                    <input type="radio" value="1" name="genero">F
                                                </fieldset>
                                            </td>

                                            <td class="p-0 m-0"><select style="font-size: 10px; height: 10% "
                                                                        id="carrera" name="carrera"
                                                                        class="form-control">
                                                    <option value="0">Carrera</option>
                                                    @foreach($carreras as $carrera)
                                                        <option value="{{ (string)$carrera->idcarrera }}">{{ $carrera->nombrecarrera }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td colspan="3" class="p-0 m-0">
                                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                                    Insertar
                                                </button>
                                            </td>
                                        </tr>
                                    </form>
                                    </tbody>
                                </table>
                            @else
                                <table class="table table-bordered" style="table-layout: inherit" id="app">

                                    <tbody>
                                    <tr>
                                        <th class="p-0 m-0">C&eacute;dula</th>
                                        <th class="p-0 m-0">Nombres</th>
                                        <th class="p-0 m-0">Tipo</th>
                                        <th class="p-0 m-0">Celular</th>
                                        <th class="p-0 m-0">Correo</th>
                                        <th class="p-0 m-0">Carrera</th>
                                        @if(!Auth::user()->hasRole('tut'))
                                            <th class="p-0 m-0">Horas</th>
                                        @endif
                                        @if(Auth::user()->hasRole('coord'))
                                            <th class="p-0 m-0"></th>
                                        @endif


                                    </tr>

                                    @foreach($estudiantes as $estudiante)
                                        <tr is="estudiantes-componente" :estudiante="{{$estudiante}}"
                                            :carrera="{{$estudiante->carrera}}"
                                            :rol="{{ Auth::user()->roles->first()}}" isactivo="true">
                                        </tr>
                                    @endforeach
                                    @foreach($estudiantes2 as $estudiante)
                                        <tr is="estudiantes-componente" :estudiante="{{$estudiante}}"
                                            :carrera="{{$estudiante->carrera}}"
                                            :rol="{{ Auth::user()->roles->first()}}" isactivo="false">
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @endif


                        </div>
                    </div>
                    <div class="card-footer small text-muted"></div>
                </div>

            </div>
        </div>
    </div>

@stop