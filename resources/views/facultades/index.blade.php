@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Facultades</li>
@endsection

@section('content')

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3" id="app">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <h1>FACULTADES</h1></div>
                                <div class="btn-group mr-2">
                                    <facultades-nuevo></facultades-nuevo>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th  class="p-0 m-0">Codigo</th>
                                        <th  class="p-0 m-0">Nombre</th>
                                        <th  class="p-0 m-0">Descripci&oacute;n</th>
                                        <th  class="p-0 m-0">Misi&oacute;n</th>
                                        <th  class="p-0 m-0">Visi&oacute;n</th>
                                        <th  class="p-0 m-0">Sede</th>
                                        <th  class="p-0 m-0"></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($facultades as $facultad)
                                        <tr is="facultades-componente" :facultad="{{ $facultad }}" :sede="{{ $facultad->sede }}"></tr>

                                    @endforeach
                                    {{--@foreach($facultades as $facultad)
                                        <tr>
                                            <td  class="p-0 m-0">{{ $facultad->idfacultad }}</td>
                                            <td  class="p-0 m-0">{{ $facultad->nombrefacultad }}</td>
                                            <td  class="p-0 m-0">{{ $facultad->descripcionfacultad }}</td>
                                            <td  class="p-0 m-0">{{ $facultad->misionfacultad }}</td>
                                            <td  class="p-0 m-0">{{ $facultad->visionfacultad }}</td>
                                            <td  class="p-0 m-0">{{ $facultad->sede->nombresede }}</td>
                                            <td  class="p-0 m-0" style="width:7%"> <!-- show the nerd (uses the show method found at GET /nerds/{id}
                                                <a class="btn btn-small btn-success" href="{{ URL::to('facultades/' . $facultad->idfacultad) }}">ver
                                                </a>-->
                                                <div class="row p-0 m-0">
                                                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                    <div class="col">
                                                <a  class="btn btn-link p-0 m-0" href="{{ URL::to('facultades/' . $facultad->idfacultad . '/edit') }}">

                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a></div>

                                                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                    <div class="col">
                                                {{ Form::open(array('url' => 'facultades/' . $facultad->idfacultad, 'class' => '')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                    <button type="submit" class="btn btn-link p-0 m-0"><i class="fa fa-fw fa-trash-alt" style="color: #f10407"></i></button>
                                                {{ Form::close() }}
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>

                </div>
            </div>
        </div>


@stop