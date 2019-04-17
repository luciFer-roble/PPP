@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nueva Escuela</h1>
    @endsection
@section('nav')
<li class="breadcrumb-item"><a href="/">Inicio</a></li>
<li class="breadcrumb-item"><a href="/escuelas">Escuelas</a></li>
<li class="breadcrumb-item active">Nueva</li>
    @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

            <form method="POST" action="/escuelas">

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

                    <div class="formgroup">
                        <label for="titulacion">Titulacion:</label>
                        <input type="text" class="form-control" id="titulacion" name="titulacion">
                    </div>

                    <div class="formgroup">
                        <label for="mision">Mision:</label>
                        <input type="text" class="form-control" id="mision" name="mision">
                    </div>

                    <div class="formgroup">
                        <label for="vision">Vision:</label>
                        <input type="text" class="form-control" id="vision" name="vision">
                    </div>

                    <div class="formgroup">
                        <label for="duracion">Duracion:</label>
                        <input type="text" class="form-control" id="duracion" name="duracion">
                    </div>

                    <div class="formgroup">
                        <label for="modalidad">Modalidad:</label>
                        <input type="text" class="form-control" id="modalidad" name="modalidad">
                    </div>

                    <div class="formgroup">
                        <label for="campo">Campo:</label>
                        <input type="text" class="form-control" id="campo" name="campo">
                    </div>

                    <div class="formgroup">
                        <label for="titulo">Titulo:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo">
                    </div>

                    <div class="formgroup" width="100">
                        <label for="facultad">Facultad:</label>
                        <select id="facultad" name="facultad" class="form-control">
                            @if (empty($facultad))
                                @foreach($facultades as $facultad)
                                    <option value="{{ (string)$facultad->idfacultad }}">{{ $facultad->nombrefacultad }}</option>
                                @endforeach
                            @else
                                @foreach($facultades as $fac)
                                    <option value="{{ $fac->idfacultad }}"

                                            @if($fac->idfacultad == $facultad->idfacultad)
                                            selected
                                            @endif


                                    >{{ $fac->nombrefacultad }}</option>
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