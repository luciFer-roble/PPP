@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Escuelas</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/escuelas">Escuelas</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">


            {{Form::open( ['method'=>"PUT", 'url'=>array("/escuelas", $escuela->idescuela)]) }}

                {{ csrf_field() }}
                <div class="card-body">
                    <div class="formgroup" width="100">
                        <label for="id">Id:</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{ $escuela->idescuela }}">
                    </div>
                    <div class="formgroup" width="100">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $escuela->nombreescuela }}">
                    </div>

                    <div class="formgroup">
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $escuela->descripcionescuela }}">
                    </div>
                    <div class="formgroup" width="100">
                        <label for="facultad">Facultad:</label>
                        <select id="facultad" name="facultad" class="form-control">
                            @foreach($facultades as $facultad)
                                <option value="{{ $facultad->idfacultad }}"
                                        @if($facultad->idfacultad == $escuela->idfacultad)
                                        selected
                                        @endif
                                >{{ $facultad->nombrefacultad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="formgroup">
                        <label for="titulacion">Titulacion:</label>
                        <input type="text" class="form-control" id="titulacion" name="titulacion" value="{{ $escuela->titulacionescuela }}">
                    </div>
                    <div class="formgroup">
                        <label for="misiion">Mision:</label>
                        <input type="text" class="form-control" id="mision" name="mision" value="{{ $escuela->misionescuela }}">
                    </div>
                    <div class="formgroup">
                        <label for="vision">Vision:</label>
                        <input type="text" class="form-control" id="vision" name="vision" value="{{ $escuela->visionescuela }}">
                    </div>
                    <div class="formgroup">
                        <label for="duracion">Duracion:</label>
                        <input type="text" class="form-control" id="duracion" name="duracion" value="{{ $escuela->duracionescuela }}">
                    </div>
                    <div class="formgroup">
                        <label for="modalidad">Modalida:</label>
                        <input type="text" class="form-control" id="modalidad" name="modalidad" value="{{ $escuela->modalidadescuela }}">
                    </div>
                    <div class="formgroup">
                        <label for="campo">Campo:</label>
                        <input type="text" class="form-control" id="campo" name="campo" value="{{ $escuela->campoescuela }}">
                    </div>
                    <div class="formgroup">
                        <label for="titulo">Titulo:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $escuela->tituloescuela }}">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a  class="btn btn-info" href="{{ URL::to('carreras/' . $escuela->idescuela . '/create') }}">
                            Anadir Carreras
                        </a>
                        <a  class="btn btn-warning" href="{{ URL::to('carreras/' . $escuela->idescuela . '/list') }}">
                            Carreras
                        </a>
                    </div>
                </div>

            </form>

            </div>
        </div>
        </div>
    </div>
@stop