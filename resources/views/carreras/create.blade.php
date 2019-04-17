@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nueva Carrera</h1>
    @endsection
@section('nav')
<li class="breadcrumb-item"><a href="/">Inicio</a></li>
<li class="breadcrumb-item"><a href="/carreras">Carreras</a></li>
<li class="breadcrumb-item active">Nueva</li>
@endsection
@section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

            <form method="POST" action="/carreras">
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
                    <div class="formgroup" width="100">
                        <label for="escuela">Escuela:</label>
                        <select id="escuela" name="escuela" class="form-control select2" style="width: 100%;" >
                            @if (empty($escuela))
                                @foreach($escuelas as $escuela)
                                    <option value="{{ (string)$escuela->idescuela }}">{{ $escuela->nombreescuela }}</option>
                                @endforeach
                            @else
                                @foreach($escuelas as $esc)
                                    <option value="{{ $esc->idescuela }}"
                                            @if($esc->idescuela == $escuela->idescuela)
                                            selected
                                            @endif
                                    >{{ $esc->nombreescuela }}</option>
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