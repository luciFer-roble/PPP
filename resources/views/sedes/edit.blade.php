@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Sedes</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/sedes">Sedes</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
            {{Form::open( ['method'=>"PUT", 'url'=>array("/sedes", $sede->idsede)]) }}

                {{ csrf_field() }}
                    <div class="card-body">
                        <div class="formgroup" width="100">
                            <label for="id">Id:</label>
                            <input type="text" class="form-control" id="id" name="id" value="{{ $sede->idsede }}">
                        </div>
                        <div class="formgroup" width="100">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $sede->nombresede }}">
                        </div>

                        <div class="formgroup">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $sede->descripcionsede }}">
                        </div>

                        <div class="formgroup" width="100">
                            <label for="universidad">Universidad:</label>
                            <select id="universidad" name="universidad" class="form-control">
                                @foreach($universidades as $uni)
                                    <option value="{{ $uni->iduniversidad }}"
                                            @if($uni->iduniversidad == $sede->iduniversidad)
                                            selected
                                            @endif
                                    >{{ $uni->nombreuniversidad }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a  class="btn btn-info" href="{{ URL::to('facultades/' . $sede->idsede . '/create') }}">
                                Anadir Facultades
                            </a>
                            <a  class="btn btn-warning" href="{{ URL::to('facultades/' . $sede->idsede . '/list') }}">
                                Facultades
                            </a>
                            <a  class="btn btn-info" href="{{ URL::to('convenios/' . $sede->idsede . '/create') }}">
                                Anadir Convenios
                            </a>
                            <a  class="btn btn-warning" href="{{ URL::to('convenios/' . $sede->idsede . '/list') }}">
                                Convenios
                            </a>
                        </div>
                    </div>

            </form>

                </div>
            </div>

        </div>
    </div>
@stop