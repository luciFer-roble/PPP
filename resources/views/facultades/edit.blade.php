@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Facultades</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/facultades">Facultades</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

            {{Form::open( ['method'=>"PUT", 'url'=>array("/facultades", $facultad->idfacultad)]) }}

                {{ csrf_field() }}
                    <div class="card-body">
                        <div class="formgroup" width="100">
                            <label for="id">Id:</label>
                            <input type="text" class="form-control" id="id" name="id" value="{{ $facultad->idfacultad }}">
                        </div>
                        <div class="formgroup" width="100">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $facultad->nombrefacultad }}">
                        </div>

                        <div class="formgroup">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $facultad->descripcionfacultad }}">
                        </div>
                        <div class="formgroup" width="100">
                            <label for="mision">Mision:</label>
                            <input type="text" class="form-control" id="mision" name="mision" value="{{ $facultad->misionfacultad }}">
                        </div>

                        <div class="formgroup">
                            <label for="vision">Vision:</label>
                            <input type="text" class="form-control" id="vision" name="vision" value="{{ $facultad->visionfacultad }}">
                        </div>
                        <div class="formgroup" width="100">
                            <label for="sede">Sede:</label>
                            <select id="sede" name="sede" class="form-control">
                                @foreach($sedes as $sede)
                                    <option value="{{ $sede->idsede }}"
                                            @if($sede->idsede == $facultad->idsede)
                                            selected
                                            @endif
                                    >{{ $sede->nombresede }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a  class="btn btn-info" href="{{ URL::to('escuelas/' . $facultad->idfacultad . '/create') }}">
                                Anadir Escuelas
                            </a>
                            <a  class="btn btn-warning" href="{{ URL::to('escuelas/' . $facultad->idfacultad . '/list') }}">
                                Escuelas
                            </a>
                        </div>
                    </div>

            </form>

                </div>
            </div>
        </div>
    </div>
@stop