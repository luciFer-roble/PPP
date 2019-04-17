@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nueva Empresa</h1>
    @endsection
@section('nav')
<li class="breadcrumb-item"><a href="/">Inicio</a></li>
<li class="breadcrumb-item"><a href="/empresas">Empresas</a></li>
<li class="breadcrumb-item active">Nueva</li>
    @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
            <form method="POST" action="/empresas">

                {{ csrf_field() }}
                <div class="card-body">
                        <div class="formgroup" class="col-lg-6">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>

                    <div class="formgroup">
                        <label for="direccion">Direccion:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion">
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                            <select id="tipo" name="tipo" class="form-control">
                                <option value="Publica"
                                >Publica</option>
                                <option value="Privada"
                                >Privada</option>
                                <option value="Sin fines de lucro"
                                >Sin fines de lucro</option>
                                <option value="Organismo Internacional"
                                >Organismo Internacional</option>
                            </select>
                    </div>

                    <div class="formgroup">
                        <label for="sector">Sector:</label>
                            <select id="sector" name="sector" class="form-control">
                                <option value="Primario"
                                >PRIMARIO (Agricultura, Ganadería, Pesca, Minería)</option>
                                <option value="Secundario"
                                >SECUNDARIO (Industria, Construcción)</option>
                                <option value="Terciario"
                                >TERCIARIO (Comercio, Servicios)</option>
                            </select>
                       </div>

                    <div class="formgroup">
                        <label for="telefono">Telefono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
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