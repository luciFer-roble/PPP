@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Sede</h1>
    @endsection
@section('nav')
<li class="breadcrumb-item"><a href="/">Inicio</a></li>
<li class="breadcrumb-item"><a href="/sedes">Sedes</a></li>
<li class="breadcrumb-item active">Nuevo</li>
    @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

            <form method="POST" action="/sedes">

                {{ csrf_field() }}
                <div class="card-body">
                    <div class="formgroup" width="100">
                        <label for="id">Id:</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="formgroup" width="100">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>

                    <div class="formgroup">
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                    </div>

                    <div class="form-group" width="100">
                        <label for="universidad">Universidad:</label>
                        <select id="universidad" name="universidad" class="form-control">
                            @if (empty($universidad))
                                @foreach($universidades as $universidad)
                                    <option value="{{ (string)$universidad->iduniversidad }}">{{ $universidad->nombreuniversidad }}</option>
                                @endforeach
                            @else
                                @foreach($universidades as $uni)
                                    <option value="{{ $uni->iduniversidad }}"
                                            @if($uni->iduniversidad == $universidad->iduniversidad)
                                            selected
                                            @endif
                                    >{{ $uni->nombreuniversidad }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>

            </form>


</div>
            </div>
        </div>
    </div>
@stop