@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Practicas</li>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->

        <div class="row">

            <div class="col-12" id="app">
                <!-- Example DataTables Card-->

                @if(Auth::user()->hasRole('admin') or Auth::user()->hasRole('est')or Auth::user()->hasRole('prof')
                or Auth::user()->hasRole('tut') or  (Auth::user()->hasRole('coord') and (!empty($profesor) or !empty($estudiante))))

                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <h1>PRACTICAS</h1></div>
                                @if(Auth::user()->hasRole('admin'))
                                <div class="btn-group mr-2">
                                    <input type="button" onClick="location.href = 'practicas/create'"
                                           class="btn btn-sm btn-outline-success" value="NUEVA"></input>
                                </div>
                                     @endif

                            </div>
                            `
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="p-0 m-0">No.</th>
                                        <th class="p-0 m-0">Estudiante</th>
                                        <th class="p-0 m-0">Empresa</th>
                                        <th class="p-0 m-0">Tutor Acad&eacute;mico</th>
                                        <th class="p-0 m-0">Tutor Empresarial</th>
                                        <th class="p-0 m-0">Tipo</th>
                                        <th class="p-0 m-0">Descripci&oacute;n</th>
                                        <th class="p-0 m-0">Periodo</th>
                                        <th class="p-0 m-0">Inicio</th>
                                        <th class="p-0 m-0">Fin</th>
                                        <th class="p-0 m-0">Horas</th>
                                        <th class="p-0 m-0">Horario</th>
                                        <th class="p-0 m-0">Salario</th>
                                        <td class="p-0 m-0" colspan="2"></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($practicas as $practica)
                                        <tr style="font-size: 12px">
                                            <td class="p-0  m-0">{{ $practica->idpractica }}</td>
                                            <td class="p-0  m-0">{{ $practica->estudiante->nombresestudiante .' '. $practica->estudiante->apellidosestudiante }}</td>
                                            <td class="p-0  m-0">{{ $practica->tutore->empresa->nombreempresa }}</td>
                                            <td class="p-0  m-0">{{ $practica->profesor->nombresprofesor .' '. $practica->profesor->apellidosprofesor }}</td>
                                            <td class="p-0  m-0">{{ $practica->tutore->nombretutore .' '. $practica->tutore->apellidotutore }}</td>
                                            <td class="p-0  m-0">{{ $practica->tipopractica }}</td>
                                            <td class="p-0  m-0">{{ $practica->descripcionpractica }}</td>
                                            <td class="p-0  m-0">{{ $practica->periodoacademico->nombreperiodoacademico }}</td>
                                            <td class="p-0  m-0">{{ $practica->fechainiciopractica }}</td>
                                            <td class="p-0  m-0">{{ $practica->fechafinpractica }}</td>
                                            <td class="p-0  m-0">{{ $practica->horaspractica }}</td>
                                            <td class="p-0  m-0">{{ $practica->horariopractica }}</td>
                                            <td class="p-0  m-0">{{ $practica->salariopractica }}</td>
                                            @if(!Auth::user()->hasRole('admin'))
                                            <td class="m-0 p-0 " align="center">
                                                <a title="Ver Practica" class="btn text-info p-0 m-0"
                                                   href="{{ URL::to('practicas/' . $practica->idpractica).'/edit'}}">
                                                    <i class="fa fa-external-link-alt"></i>
                                                </a>
                                            </td>
                                            @else
                                            <td class="p-0  m-0">
                                                <a class="btn btn-link p-0 m-0"
                                                   href="{{ URL::to('practicas/' . $practica->idpractica . '/edit') }}">

                                                    <i class="fa fa-fw fa-pencil-alt"></i></a>
                                            </td>
                                            <td class="p-0 m-0" is="boton-borrar-practica" :practica="{{ $practica }}"></td>
                                                @endif

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                {{--@elseif(Auth::user()->hasRole('est')or Auth::user()->hasRole('prof') or Auth::user()->hasRole('tut') or  (Auth::user()->hasRole('coord') and (!empty($profesor) or !empty($estudiante))))
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <h1>PRACTICAS</h1></div>
                                <div class="btn-group mr-2">
                                    <input type="button" onClick="location.href = 'practicas/create'"
                                           class="btn btn-sm btn-outline-success" value="NUEVA"></input>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="m-0 p-0">Estudiante</th>
                                        <th class="m-0 p-0">Inicio</th>
                                        <th class="m-0 p-0">Fin</th>
                                        <th class="m-0 p-0">Tipo de proyecto</th>
                                        <th class="m-0 p-0"># Horas</th>
                                        <th class="m-0 p-0">Empresa</th>
                                        <th class="m-0 p-0">Tipo Empresa</th>
                                        <th class="m-0 p-0">Sector</th>
                                        <th class="m-0 p-0">Tutor Academico</th>
                                        <th class="m-0 p-0">Tutor Empresarial</th>
                                        <th class="m-0 p-0"></th>
                                    </tr>
                                    </thead>
                                    <tbody style="font-size: 10%">
                                    @foreach($practicas as $practica)

                                        <tr>
                                            <td class="m-0 p-0"><a class="btn btn-link m-0 p-0"
                                                                   href="{{ URL::to('estudiantes/' . $practica->idestudiante) }}">{{ $practica->estudiante->nombresestudiante}} {{$practica->estudiante->apellidosestudiante}} {{$practica->estudiante->apellido2estudiante}}</a>
                                            </td>
                                            <td class="m-0 p-0"><span
                                                        class="btn border-0  m-0 p-0">{{ $practica->fechainiciopractica }}</span>
                                            </td>
                                            <td class="m-0 p-0"><span
                                                        class="btn border-0  m-0 p-0">{{ $practica->fechafinpractica }}</span>
                                            </td>
                                            <td class="m-0 p-0"><span
                                                        class="btn border-0  m-0 p-0">{{ $practica->tipopractica }}</span>
                                            </td>
                                            <td class="m-0 p-0"><span
                                                        class="btn border-0  m-0 p-0">{{ $practica->horaspractica }}</span>
                                            </td>
                                            <td class="m-0 p-0"><a class="btn btn-link m-0 p-0"
                                                                   href="{{ URL::to('empresas/' . $practica->idempresa) }}">{{$practica->tutore->empresa->nombreempresa}}</a>
                                            </td>
                                            <td class="m-0 p-0"><span
                                                        class="btn border-0  m-0 p-0">{{ $practica->tutore->empresa->tipoempresa}}</span>
                                            </td>
                                            <td class="m-0 p-0"><span
                                                        class="btn border-0  m-0 p-0">{{ $practica->tutore->empresa->sectorempresa}}</span>
                                            </td>
                                            <td class="m-0 p-0"><a class="btn btn-link m-0 p-0"
                                                                   href="{{ URL::to('profesores/' . $practica->idprofesor) }}">{{ $practica->profesor->nombresprofesor}} {{$practica->profesor->apellidosprofesor }}</a>
                                            </td>
                                            <td class="m-0 p-0"><a class="btn btn-link m-0 p-0"
                                                                   href="{{ URL::to('tutores/' . $practica->idtutore) }}">{{ $practica->tutore->nombretutore}} {{$practica->tutore->apellidotutore }}</a>
                                            </td>
                                            <td class="m-0 p-0 " align="center">

                                                <a class="btn text-info p-0 m-0"
                                                   href="{{ URL::to('practicas/' . $practica->idpractica).'/edit'}}">
                                                    <i class="fa fa-external-link-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
--}}





                @else
                    <div class="col-12" id="app">

                        <div class="card mb-3">
                        <consulta-praticas></consulta-praticas>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>





@stop