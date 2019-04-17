@section('titulo')
    <h1 class="m-0 text-dark">Editar Empresa</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/formatos">Formatos</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="container-fluid">
        @extends('layouts.master')
        <div class="row">
            <div class="col-12">
                <div class="card">

            {{Form::open( ['method'=>"PUT", 'url'=>array("/formatos", $formato->idtipodocumento), 'files'=>true]) }}

                {{ csrf_field() }}
                    <div class="card-body">
                        <div class="formgroup" width="100">
                            <label for="id">Id:</label>
                            <input type="text" class="form-control" id="id" name="id" value="{{ $formato->idtipodocumento }}" readonly>
                        </div>

                        <div class="formgroup">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $formato->tipodocumento->descripciontipodocumento }}">
                        </div>
                        <div class="form-group">
                            <label for="archivo">Archivo de Formato:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="archivo" name="archivo">
                                    <label class="custom-file-label" for="archivo">
                                      {{$formato->archivoformato}}
                                    </label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Cargar</span>
                                </div>
                            </div>
                        </div>

                    </div>
               <div class="card-footer">
                   <div class="form-group">
                       <button type="submit" class="btn btn-primary">Guardar</button>
                      {{-- <a  class="btn btn-primary" href="{{ URL::to('tutores/' . $tipodocumento->idtipodocumento . '/create') }}">
                           Anadir Tutor
                       </a>
                       <a  class="btn btn-primary" href="{{ URL::to('tutores/' . $tipodocumento->idtipodocumento . '/list') }}">
                           Tutores
                       </a>--}}
                   </div>
               </div>


            </form>

                </div>
            </div>
        </div>
    </div>
@stop