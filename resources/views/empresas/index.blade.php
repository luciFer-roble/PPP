@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Empresas</li>
@endsection

@section('content')

        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <div class="row" >
                <div class="col-12" >
                    <!-- Example DataTables Card-->
                    <div class="card mb-3" id="app">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <h1>EMPRESAS</h1></div>
                                <div class="btn-group mr-2 justify-content-end">
                                @if(Auth::user()->hasRole('coord'))
                                        <input type="button" onClick="location.href = 'convenios'" class="btn btn-sm btn-light" value="Administrar Convenios">&nbsp; &nbsp;
                                @endif
                                    @if(Auth::user()->hasRole('admin') or Auth::user()->hasRole('coord'))
                                    <empresa-nuevo></empresa-nuevo>
                                        @endif
                                </div>
                        </div>
                        </div>
                        <div class="card-body" >
                                @if(Auth::user()->hasRole('admin'))
                                <div class="table-responsive" id="app">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="p-0 m-0">Nombre</th>
                                        <th class="p-0 m-0">Direcci&oacute;n</th>
                                        <th class="p-0 m-0">Tipo</th>
                                        <th class="p-0 m-0">Sector</th>
                                        <th class="p-0 m-0">Tel&eacute;fono 1</th>
                                        <th class="p-0 m-0">Tel&eacute;fono 2</th>
                                        <th class="p-0 m-0">Responsable</th>
                                        <th class="p-0 m-0">Tel. Responsable</th>
                                        <td class="p-0 m-0"></td>

                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($empresas as $empresa)
                                            <tr is="empresas-componente" :empresa="{{ $empresa }}" ></tr>

                                        @endforeach
                                    </tbody>
                                </table>

                                </div>
                                @endif
                            @if(Auth::user()->hasRole('prof') or Auth::user()->hasRole('coord'))
                                        <div class="table-responsive">
                                            @foreach($empresas as $empresa)
                                                  <empresa-item  :empresa="{{ $empresa }}" :convenios="{{ $convenios }}" :rol="{{ Auth::user()->roles->first() }}"
                                                :sedeuser="{{ Auth::user()->profesor->escuela->facultad->sede }}">
                                                </empresa-item>
                                            @endforeach
                                        </div>
                                @endif
                            @if(Auth::user()->hasRole('est'))
                                        <div class="table-responsive">
                                            @foreach($empresas as $empresa)
                                                <empresa-item  :empresa="{{ $empresa }}" :convenios="{{ $convenios }}" :rol="{{ Auth::user()->roles->first() }}"
                                                               :sedeuser="{{ Auth::user()->estudiante->carrera->escuela->facultad->sede }}">
                                                </empresa-item>
                                            @endforeach
                                        </div>
                                @endif

                        </div>

                        <nav>
                            <ul class="pagination justify-content-center">
                                {{$empresas->links('vendor.pagination.bootstrap-4')}}
                            </ul>
                        </nav>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>

                </div>
            </div>
        </div>


@stop