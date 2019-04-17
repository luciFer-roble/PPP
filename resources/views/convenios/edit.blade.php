@section('titulo')
    <h1 class="m-0 text-dark">Editar Convenios</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/convenios">Convenios</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="container-fluid">
        @extends('layouts.master')
        <div class="row">
            <div class="col-12">
                <div class="card">

            {{Form::open( ['method'=>"PUT", 'url'=>array("/convenios", $convenio->idconvenio), 'files'=>true]) }}

                {{ csrf_field() }}
                    <div class="card-body">
                        <div class="formgroup" width="100">
                            <label for="id">Id:</label>
                            <input type="text" class="form-control" id="id" name="id" value="{{ $convenio->idconvenio }}" readonly>
                        </div>
                        <div class="formgroup" width="100">
                            <label for="sede">Sede:</label>
                            <select id="sede" name="sede" class="form-control">
                                @foreach($sedes as $sede)
                                    <option value="{{ $sede->idsede }}"
                                            @if($sede->idsede == $convenio->idsede)
                                            selected
                                            @endif
                                    >{{ $sede->nombresede }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="formgroup" width="100">
                            <label for="empresa">Empresa:</label>
                            <select id="empresa" name="empresa" class="form-control">
                                @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->idempresa }}"
                                            @if($empresa->idempresa == $convenio->idempresa)
                                            selected
                                            @endif
                                    >{{ $empresa->nombreempresa }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="formgroup">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $convenio->descripcionconvenio }}">
                        </div>
                        <div class="formgroup">
                            <label for="descripcion">Fecha de Inicio:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control"id="inicio" name="inicio"  data-inputmask="'alias': 'dd/mm/yyyy'" value="{{ $convenio->fechainicioconvenio }}">
                            </div>
                        </div>
                        <div class="formgroup">
                            <label for="descripcion">Fecha de Fin:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control"id="fin" name="fin" data-inputmask="'alias': 'dd/mm/yyyy'" value="{{ $convenio->fechafinconvenio }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="archivo">Archivo de Formato:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="archivo" name="archivo">
                                    <label class="custom-file-label" for="archivo">
                                      {{$convenio->archivoconvenio}}
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
                      {{-- <a  class="btn btn-primary" href="{{ URL::to('tutores/' . $convenio->idconvenio . '/create') }}">
                           Anadir Tutor
                       </a>
                       <a  class="btn btn-primary" href="{{ URL::to('tutores/' . $convenio->idconvenio . '/list') }}">
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