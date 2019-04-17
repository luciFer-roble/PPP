@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Usuario</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active">{{ Auth::user()->name}}</li>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">
            {{--<div class="col-4"></div>--}}
            <div class="col-5">


                <!-- Example DataTables Card-->
                <div class="card " id="app">
                    @if(Auth::user()->hasRole('admin'))
                           {{Form::open( ['method'=>"PUT", 'url'=>array("/users", $user->id), 'files'=>true]) }}

                           {{ csrf_field() }}
                           <div class="card-body">
                               <table class="table ">
                                  <tr>
                                      <th style="width:18%"><strong>Nombre:</strong> </th>
                                      <td>{{ $user->name }}</td>
                                  </tr>
                                   <tr>
                                       <th style="width:18%"><strong>Correo:</strong></th>
                                       <td>{{ $user->email }}</td>
                                   </tr>
                                   <tr>
                                       <td colspan="2">
                                           <div class="form-group">
                                               <div class="image">
                                                   <img src="/uploads/avatars/{{$user->avatar}}"
                                                        alt="User Image">

                                               </div>
                                               {{--<div class="input-group">
                                                   <div class="custom-file">
                                                       <input type="file" class="" id="foto" name="foto">
                                                       <label for="foto"></label>
                                                   </div>

                                               </div>--}}
                                               <avatar-nuevo></avatar-nuevo>

                                           </div>
                                       </td>

                                   </tr>

                               </table>
                           </div>
                    @else
                        {{Form::open( ['method'=>"PUT", 'url'=>array("/users", $usuario->id), 'files'=>true]) }}

                        {{ csrf_field() }}
                        <div class="card-body">
                            <table >
                                <tr>
                                    <th style="width:18%" for="nombre">Nombre:</th>
                                    <td><input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->nombre }}" disabled></td>
                                </tr>
                                <tr>
                                    <th style="width:18%" for="apellido">Apellido:</th>
                                    <td><input type="text" class="form-control" id="apellido" name="apellido" value="{{ $usuario->apellido }}"disabled></td>
                                </tr>
                                <tr>
                                    <th style="width:18%" for="celular">Celular:</th>
                                    <td><input type="text" class="form-control" id="celular" name="celular" value="{{ $usuario->celular}}"></td>
                                </tr>
                                <tr>
                                    <th style="width:18%" for="correo">Correo:</th>
                                    <td><input type="text" class="form-control" id="correo" name="correo" value="{{ $usuario->correo }}"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <div class="image">
                                            <img class="img-thumbnail" width="200" height="200" src="/uploads/avatars/{{$usuario->avatar}}"
                                                 alt="User Image">

                                        </div>
                                        <avatar-nuevo></avatar-nuevo>
                                        {{--<div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="" id="foto" name="foto">
                                                <label for="foto"></label>
                                            </div>

                                        </div>--}}
                                    </td>
                                </tr>

                            </table>
                        </div>
                    @endif
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