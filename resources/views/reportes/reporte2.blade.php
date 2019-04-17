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
                        <h3>{{ $periodo->descripcionperiodoacademico }}</h3></div>

                    <div class="btn-group mr-2 float-right">
                        <input type="button" data-toggle="modal" data-target="#modal1"
                               class="btn btn-sm btn-outline-danger" value="Grafico"/>
                        <input type="button" onClick="location.href = '/reportes/{{ $periodo->idperiodoacademico }}/descarga2'"
                               class="btn btn-sm btn-outline-success" value="EXCEL"/>
                    </div>

                </div>
                `
            </div>
            <div class="card-body p-0 m-0" id="app">

                <div class="table-responsive">

                    <table class="table table-bordered p-0 m-0 border-0" id="dataTable" width="100%" style="table-layout: fixed;  display: table;">
                        <thead>
                        <tr>
                            <th  style="width:  12%" class="p-1 m-0">Identificacion</th>
                            <th  style="width:  16%" class="p-1 m-0">Apellidos y Nombres</th>
                            <th  style="width:  13%" class="p-1 m-0">Unidad Academica</th>
                            <th  style="width:  25%" class="p-1 m-0">Carrera</th>
                            <th  style="width:  13%" class="p-1 m-0">Celular</th>
                            <th  style="width:  14%" class="p-1 m-0">Correo</th>
                            <th  colspan="2"  style="width:  7.318912295584146%;" class="p-1 m-0">Horas</th>
                        </tr>
                        </thead>
                    </table>
                    @foreach($estudiantes as $estudiante)
                        <estudiante-periodo  :estudiante="{{ $estudiante }}" carrera="{{ $estudiante->carrera->nombrecarrera }}"
                                          facultad="{{ $estudiante->carrera->escuela->facultad->nombrefacultad }}"
                                            periodo="{{ $periodo->idperiodoacademico }}"></estudiante-periodo>
                    @endforeach
                </div>
            </div>

            <!-- Modal reporte 3-->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <chart-reporte2 ></chart-reporte2>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Imprimir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop