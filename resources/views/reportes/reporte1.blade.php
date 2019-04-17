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
                        <h4 class="text-secondary">Estudiantes que Culminaron sus Prácticas  en el Periodo {{ $periodo->descripcionperiodoacademico }}</h4></div>

                    <div class="btn-group mr-2 float-right">
                        <span  data-toggle="modal" data-target="#modal1"
                              class="btn btn-sm btn-light" ><i class="fas fa-chart-bar"></i>&nbsp;GRAFICO</span>&nbsp;
                        <span  onClick="location.href = '/reportes/{{ $periodo->idperiodoacademico }}/descarga1'"
                               class="btn btn-sm btn-outline-success" ><i class="fas fa-download"></i>&nbsp;EXCEL</span>
                    </div>

                </div>
                `
            </div>
            <div class="card-body p-0 m-0" id="app">

                <div class="table-responsive">
                    @if(count($estudiantes) === 0)
                        <table class="table table-bordered">
                            <tr><td align="center"><h6 class="text-secondary">NO HAY DATOS</h6></td></tr>
                        </table>
                        @endif
                        @foreach($estudiantes as $estudiante)
                            <estudiante-item  :estudiante="{{ $estudiante }}" carrera="{{ $estudiante->carrera->nombrecarrera }}"
                                facultad="{{ $estudiante->carrera->escuela->facultad->nombrefacultad }}"
                                :periodo="{{ $periodo }}"></estudiante-item>
                        @endforeach
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
                            <chart-reporte1 ></chart-reporte1>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@stop