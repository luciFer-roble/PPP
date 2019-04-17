@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Reportes</li>
@endsection

@section('content')

    <div class="container-fluid" id="app">
        <div class="card mb-3">
            @if(count($estudiantes) === 0)
                <table class="table table-bordered">
                    <tr><td align="center"><h6 class="text-secondary">NO HAY DATOS</h6></td></tr>
                </table>
            @endif
        <table class="table table-bordered" style="table-layout: inherit"  >

            <tbody>
            @if(count($estudiantes) > 0)
                <tr>
                    <th class="p-0 m-0">C&eacute;dula</th>
                    <th class="p-0 m-0">Nombres</th>
                    <th class="p-0 m-0">Tipo</th>
                    <th class="p-0 m-0">Celular</th>
                    <th class="p-0 m-0">Correo</th>
                    <th class="p-0 m-0" >Carrera</th>
                    @if(!Auth::user()->hasRole('tut'))
                        <th class="p-0 m-0" >Horas</th>
                    @endif
                    @if(Auth::user()->hasRole('coord'))
                        <th class="p-0 m-0"></th>
                    @endif


                </tr>
            @endif

            @foreach($estudiantes as $estudiante)
                <tr is="estudiantes-componente" :estudiante="{{$estudiante}}" :carrera="{{$estudiante->carrera}}"
                    :rol="{{ Auth::user()->roles->first()}}" isactivo="true">
                </tr>
            @endforeach
            @foreach($estudiantes2 as $estudiante)
                <tr is="estudiantes-componente" :estudiante="{{$estudiante}}" :carrera="{{$estudiante->carrera}}"
                    :rol="{{ Auth::user()->roles->first()}}" isactivo="false">
                </tr>
            @endforeach

            </tbody>
        </table>
        </div>
    </div>


@stop