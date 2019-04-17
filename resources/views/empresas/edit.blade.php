@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Empresa</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/empresas">Empresas</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

            {{Form::open( ['method'=>"PUT", 'url'=>array("/empresas", $empresa->idempresa)]) }}

                {{ csrf_field() }}
                    <div class="card-body">
                        <div class="formgroup" width="100">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $empresa->nombreempresa }}">
                        </div>

                        <div class="formgroup">
                            <label for="direccion">Direccion:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $empresa->direccionempresa }}">
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo:</label>
                                <select id="tipo" name="tipo" class="form-control">
                                    <option value="Publica"
                                            @if("Publica" == $empresa->tipoempresa)
                                            selected
                                            @endif
                                    >Publica</option>
                                    <option value="Privada"
                                            @if("Privada" == $empresa->tipoempresa)
                                            selected
                                            @endif
                                    >Privada</option>
                                    <option value="Sin fines de lucro"
                                            @if("Sin fines de lucro" == $empresa->tipoempresa)
                                            selected
                                            @endif
                                    >Sin fines de lucro</option>
                                    <option value="Organismo Internacional"
                                            @if("Organismo Internacional" == $empresa->tipoempresa)
                                            selected
                                            @endif
                                    >Organismo Internacional</option>
                                </select>
                        </div>
                        <div class="formgroup">
                            <label for="sector">Sector:</label>
                            <select id="sector" name="sector" class="form-control">
                                <option value="Primario"
                                        @if("Primario" == $empresa->sectorempresa)
                                        selected
                                        @endif
                                >PRIMARIO (Agricultura, Ganadería, Pesca, Minería)</option>
                                <option value="Secundario"
                                        @if("Secundario" == $empresa->sectorempresa)
                                        selected
                                        @endif
                                >SECUNDARIO (Industria, Construcción)</option>
                                <option value="Terciario"
                                        @if("Terciario" == $empresa->sectorempresa)
                                        selected
                                        @endif
                                >TERCIARIO (Comercio, Servicios)</option>
                            </select>
                        </div>

                        <div class="formgroup">
                            <label for="telefono">Telefono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $empresa->telefonoempresa }}">
                        </div>

                    </div>
               <div class="card-footer">
                   <div class="form-group">
                       <button type="submit" class="btn btn-primary">Guardar</button>
                       <a  class="btn btn-primary" href="{{ URL::to('tutores/' . $empresa->idempresa . '/create') }}">
                           Anadir Tutor
                       </a>
                       <a  class="btn btn-primary" href="{{ URL::to('tutores/' . $empresa->idempresa . '/list') }}">
                           Tutores
                       </a>
                   </div>
               </div>


            </form>

                </div>
            </div>
        </div>
    </div>
@stop