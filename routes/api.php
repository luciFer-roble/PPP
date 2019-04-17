<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('asignaturas-nivel','ConsultasController@listarasignaturas');
Route::get('consultar-practicas','ConsultasController@consultarpracticas');
Route::get('listar-select1','ConsultasController@listarselect1');
Route::get('consultar2-practicas','ConsultasController@consultarpracticas2');
Route::get('todo-practicas','ConsultasController@todaslaspracticas');
Route::get('totaldocs','ConsultasController@totaldocs');
Route::get('consultar-practicas-por-estudiante','ConsultasController@consultarpracticasporestudiante');
Route::get('consultar-tutores-por-empresa','ConsultasController@consultartutoresporempresa');
Route::get('consultar-practicas-por-periodo','ConsultasController@consultarpracticasporperiodo');
Route::get('consultar-practicas-por-tipopractica','ConsultasController@consultarpracticasportipopractica');
Route::get('consultar-practicas-por-tipoempresa','ConsultasController@consultarpracticasportipoempresa');
Route::get('consultar-practicas-por-sector','ConsultasController@consultarpracticasporsector');
Route::get('consultar-practicas-por-nivel','ConsultasController@consultarpracticaspornivel');
Route::get('totalpracticas','ConsultasController@totalpracticas');
Route::get('totalportipo','ConsultasController@totalportipo');
Route::get('totalesporperiodo','ConsultasController@totalesporperiodo');
Route::get('totalperiodos','ConsultasController@totalperiodos');
Route::get('totalespornivel','ConsultasController@totalespornivel');
Route::get('totalniveles','ConsultasController@totalniveles');
Route::get('totalesporperiodo2','ConsultasController@totalesporperiodo2');
Route::get('totalestudiantesportipoempresa','ConsultasController@totalestudiantesportipoempresa');
Route::get('totalpracticasportipoempresa','ConsultasController@totalpracticasportipoempresa');
Route::get('totalestudiantesporsectorempresa','ConsultasController@totalestudiantesporsectorempresa');
Route::get('totalpracticasporsectorempresa','ConsultasController@totalpracticasporsectorempresa');
Route::get('getprofesores','ConsultasController@getprofesores');
Route::get('getniveles','ConsultasController@getniveles');
Route::get('getempresas','ConsultasController@getempresas');
Route::get('getperiodos','ConsultasController@getperiodos');
Route::get('gettutores','ConsultasController@gettutores');
Route::get('getuniversidades','ConsultasController@getuniversidades');
Route::get('getasignaturas','ConsultasController@getasignaturas');
Route::get('getsedes','ConsultasController@getsedes');
Route::get('getfacultades','ConsultasController@getfacultades');
Route::get('getescuelas','ConsultasController@getescuelas');
Route::get('getcarrerassincoordinador','ConsultasController@getcarrerassincoordinador');
Route::get('getprofesoresnocoordinadores','ConsultasController@getprofesoresnocoordinadores');
Route::get('getcarreras','ConsultasController@getcarreras');
Route::get('getestudiantes','ConsultasController@getestudiantes');
Route::get('getestudiante','ConsultasController@getestudiante');
Route::get('getempresa','ConsultasController@getempresa');
Route::get('getprofesor','ConsultasController@getprofesor');
Route::get('gettutore','ConsultasController@gettutore');
Route::get('getcarrerauser','ConsultasController@getcarrerauser');
Route::get('consultar-estudiantes-por-profesor','ConsultasController@estudiantes_profesor');
Route::get('consultar-actividades-por-profesor','ConsultasController@actividades_profesor');
