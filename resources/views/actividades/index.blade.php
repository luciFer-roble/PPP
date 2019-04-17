@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">{{ 'Actividades de la '.$practica->tipopractica}}</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ URL::to('practicas/' . $practica->idpractica . '/edit') }}">{{ $practica->tipopractica .' '. $practica->tutore->empresa->nombreempresa}}</a></li>
    <li class="breadcrumb-item active">Actividades</li>
@endsection
@section('content')

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                    <div class="row">

                    </div>

                    <!-- DataTable Card-->
                    <div class="card mb-3">
                        <div class="card-header row">
                            <div class="col-lg-6">
                                <h5>Nombre del proyecto en el que se realiza la practica: </h5>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" value="{{ $practica->tipopractica .' '. $practica->tutore->empresa->nombreempresa}}" readonly>
                            </div>
                        </div>
                        <div class="card-body" id="app">
                            <div class="">
                                <div class="row">
                                <div class="col-1">
                                    <form method="post" action="/actividades/descargar">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="practica" value="{{ $practica->idpractica }}"/>
                                        <input type="hidden" name="pagina" value="{{ $actividades->currentPage() }}"/>
                                        <button title="DESCARGAR SEMANA" type="submit" class="btn btn-outline-info"><i class="fas fa-download"></i>&nbsp; Imprimir</button>
                                    </form>
                                </div>
                                <div class="col-11">
                                    <?php $pagination_range = 2; ?>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-end">

                                            <li class="page-item {{ $actividades->previousPageUrl()==null ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $actividades->previousPageUrl() ?? '#' }}">Anterior</a>
                                            </li>


                                            @if ($actividades->currentPage() > 1+$pagination_range )

                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $actividades->url(1) ?? '#' }}">{{ 1 }}</a>
                                                </li>

                                                @if ($actividades->currentPage() > 1+$pagination_range+1 )
                                                    <li class="page-item disabled">
                                                        <span class="page-link">&hellip;</span>
                                                    </li>
                                                @endif

                                            @endif

                                            @for ($i=-$pagination_range; $i<=$pagination_range; $i++)

                                                @if ($actividades->currentPage()+$i > 0 && $actividades->currentPage()+$i <= $actividades->lastPage())
                                                    <li class="page-item {{ $i==0 ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $actividades->url($actividades->currentPage()+$i) }}">{{ 'Semana '.($actividades->currentPage()+$i) }}</a>
                                                    </li>
                                                @endif

                                            @endfor

                                            @if ($actividades->currentPage() < $actividades->lastPage()-$pagination_range )

                                                @if ($actividades->currentPage() < $actividades->lastPage()-$pagination_range-1 )
                                                    <li class="page-item disabled">
                                                        <span class="page-link">&hellip;</span>
                                                    </li>
                                                @endif

                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $actividades->url($actividades->lastPage()) ?? '#' }}">{{ $actividades->lastPage() }}</a>
                                                </li>

                                            @endif

                                            <li class="page-item {{ $actividades->nextPageUrl()==null ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $actividades->nextPageUrl() ?? '#' }}">Siguiente</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="/actividades/{{ $practica->idpractica }}/{{ ($actividades->total())/5 }}">Nueva</a>
                                            </li>

                                        </ul>
                                    </nav>
                                </div>
                                </div>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Descripcion de Actividades</th>
                                        @if(Auth::user()->hasRole('tut') || Auth::user()->hasRole('prof'))
                                            <th>Control</th>
                                        @endif
                                        <th>Comentario</th>
                                        {{--<th>Horas</th>--}}

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($actividades as $actividad)
                                        <tr is="actividad" practica="{{ $practica->idpractica }}" :actividad="{{ $actividad }}"
                                            :rol="{{ Auth::user()->roles->first() }}">

                                        </tr>
                                    @endforeach

                                    </tbody>


                                </table>
                            </div>
                        </div>
                        <div class="card-footer small justify-content-end">
                            <a  href="{{ URL::to('practicas/' . $practica->idpractica . '/edit') }}" class="btn btn-secondary"><i class="fas fa-backward"></i>&nbsp; Regresar</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@stop