@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Reportes</li>
@endsection

@section('content')

    <div class="container-fluid" id="app">
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <h4 class="text-secondary">Prácticas Registradas en el Nivel: {{ $nivel->nombrenivel }}</h4></div>

                    <div class="btn-group mr-2 float-right">
                        <span  data-toggle="modal" data-target="#modal1"
                               class="btn btn-sm btn-light" ><i class="fas fa-chart-bar"></i>&nbsp;GRAFICO</span>&nbsp;
                        <span onClick="location.href = '/reportes/{{ $nivel->idnivel }}/descarga6'"
                              class="btn btn-sm btn-outline-success" ><i class="fas fa-download"></i>&nbsp;EXCEL</span>
                    </div>

                </div>
                `
            </div>
            <div class="card-body p-0 m-0" id="app">

                <div class="table-responsive">
                    @if(count($practicas) === 0)
                        <table class="table table-bordered">
                            <tr><td align="center"><h6 class="text-secondary">NO HAY DATOS</h6></td></tr>
                        </table>
                    @endif
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        @if(count($practicas) > 0)

                            <thead>
                            <tr>
                                <th class="m-0 p-0">No.</th>
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
                            </tr>
                            </thead>
                        @endif
                        <tbody>
                        @php
                            $contador =1;
                        @endphp
                        @foreach($practicas as $practica)
                            <tr>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $contador }}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->estudiante->nombresestudiante.' '.$practica->estudiante->apellidosestudiante}}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->fechainiciopractica }}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->fechafinpractica }}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->tipopractica }}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->horaspractica }}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->tutore->empresa->nombreempresa}}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->tutore->empresa->tipoempresa}}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->tutore->empresa->sectorempresa}}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->profesor->nombresprofesor.' '.$practica->profesor->apellidosprofesor }}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->tutore->nombretutore.' '.$practica->tutore->apellidotutore }}</span></td>

                            </tr>
                            @php
                                $contador++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- Modal reporte 3-->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <chart-reporte6></chart-reporte6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop