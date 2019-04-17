@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Profesores</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->

        <div class="row">
            <div class="col-12">

                <div class="card mb-3"  id="app">
                    <div class="card-header" id="">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <div class="btn-toolbar mb-2 mb-md-0">

                                <h1>PROFESORES</h1></div>
                            @if(Auth::user()->hasRole('admin'))
                                <div class="btn-group mr-2">
                                    <profesores-nuevo></profesores-nuevo>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="p-0 m-0" style="width: 7%">C&oacute;digo</th>
                                    <th class="p-0 m-0">Cedula</th>
                                    <th class="p-0 m-0">Nombres</th>
                                    <th class="p-0 m-0">Apellidos</th>
                                    <th class="p-0 m-0">Correo</th>
                                    <th class="p-0 m-0">Celular</th>
                                    <th class="p-0 m-0" style="width: 7%">Oficina</th>
                                    <th class="p-0 m-0">Escuela</th>
                                    @if (Auth::user()->hasRole('coord'))
                                        <th class="p-0 m-0" style="width: 4%">Tutor</th>
                                    @endif
                                    @if(Auth::user()->hasRole('admin'))
                                        <td class="p-0 m-0"></td>
                                    @endif

                                </tr>
                                </thead>
                                <tbody id="">
                                @if(Auth::user()->hasRole('coord'))
                                    @foreach($profesores as $profesor)
                                        <tr>
                                            <td class="p-0 m-0" style="width: 7%">{{ $profesor->idprofesor }}</td>
                                            <td class="p-0 m-0">{{ $profesor->cedulaprofesor }}</td>
                                            <td class="p-0 m-0">{{ $profesor->nombresprofesor }}</td>
                                            <td class="p-0 m-0">{{ $profesor->apellidosprofesor }}</td>
                                            <td class="p-0 m-0">{{ $profesor->correoprofesor }}</td>
                                            <td class="p-0 m-0">{{ $profesor->celularprofesor }}</td>
                                            <td class="p-0 m-0" style="width: 7%">{{ $profesor->oficinaprofesor }}</td>
                                            <td class="p-0 m-0">{{ $profesor->escuela->nombreescuela }}</td>
                                            <td class="p-0 m-0">
                                                <?php $haspracticas = false; ?>
                                                @foreach($practicas as $practica)
                                                    @if($profesor->idprofesor == $practica->idprofesor )
                                                        <?php $haspracticas = true ?>
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if($haspracticas == true)
                                                    <div class="col" align="center">
                                                        <a href="/practicas/{{ $profesor->idprofesor .'/list'}}"
                                                           title="Ver Tutorias" class=" btn btn-link p-0 m-0 ">
                                                            <i class="text-success fa fa-check-square"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="col" align="center">
                                                        <a class="btn p-0 m-0 ">
                                                            <i class="text-danger fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                @endif

                                            </td>


                                        </tr>
                                    @endforeach
                                @endif

                                @if(Auth::user()->hasRole('admin'))

                                    @foreach($profesores as $profesor)
                                        <tr is="profesores-componente" :profesor="{{ $profesor }}"
                                            :escuela="{{ $profesor->escuela }}"></tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    {{--<form method="POST" action="/profesores">

                                        {{ csrf_field() }}
                                        <tr >
                                            <td class="p-0 m-0" style="width: 7%"><input type="text"
                                                                                         class="form-control" id="id"
                                                                                         name="id"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="cedula"
                                                                       name="cedula"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="nombres"
                                                                       name="nombres"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="apellidos"
                                                                       name="apellidos"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="correo"
                                                                       name="correo"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="celular"
                                                                       name="celular"></td>
                                            <td class="p-0 m-0" style="width: 7%"><input type="text"
                                                                                         class="form-control"
                                                                                         id="oficina" name="oficina">
                                            </td>
                                            <td class="p-0 m-0"><select id="escuela" name="escuela"
                                                                        class="form-control">
                                                    @foreach($escuelas as $escuela)
                                                        <option value="{{ $escuela->idescuela }}">{{ $escuela->nombreescuela }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td class="p-0 m-0">
                                                <button type="submit" class="btn btn-primary btn-block">Insertar
                                                </button>
                                            </td>
                                        </tr>
                                    </form>--}}
                                @endif
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer small text-muted"></div>
                </div>

            </div>
        </div>
    </div>

@stop