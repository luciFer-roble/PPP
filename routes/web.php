<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Sede;

Route::get('/', 'HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/master',function (){
    return view ('layouts.master');
});

$sedes =Sede::all();
View::share('sedes',$sedes);


Route::get('/users/{user}', 'UsersController@show');
Route::put('/users/{user}', 'UsersController@update');

Route::get('/empresas', 'EmpresasController@index')->name('empresas.index');
Route::get('/empresas/create', 'EmpresasController@create');
Route::get('/empresas/{empresa}', 'EmpresasController@show');
Route::post('/empresas', 'EmpresasController@store');
Route::get('/empresas/{empresa}/edit', 'EmpresasController@edit');
Route::put('/empresas/{empresa}', 'EmpresasController@update');
Route::delete('/empresas/{empresa}', 'EmpresasController@destroy');


Route::get('/carreras', 'CarrerasController@index')->name('carreras.index');
Route::get('/carreras/create', 'CarrerasController@create');
Route::get('/carreras/{escuela}', 'CarrerasController@show');
Route::post('/carreras', 'CarrerasController@store');
Route::get('/carreras/{carrera}/edit', 'CarrerasController@edit');
Route::put('/carreras/{carrera}', 'CarrerasController@update');
Route::delete('/carreras/{carrera}', 'CarrerasController@destroy');
Route::get('/carreras/{escuela}/create', 'CarrerasController@createfrom');
Route::get('/carreras/{escuela}/list', 'CarrerasController@indexfrom');
Route::get('/carreras/{sede}/list2', 'CarrerasController@indexfromsede');


Route::get('/profesores', 'ProfesoresController@index')->name('profesores.index');
Route::get('/profesores/create', 'ProfesoresController@create');
Route::get('/profesores/{profesor}', 'ProfesoresController@show');
Route::post('/profesores', 'ProfesoresController@store');
Route::get('/profesores/{profesor}/edit', 'ProfesoresController@edit');
Route::put('/profesores/{profesor}', 'ProfesoresController@update');
Route::delete('/profesores/{profesor}', 'ProfesoresController@destroy');

Route::get('/coordinadores', 'CoordinadoresController@index')->name('coordinadores.index');
Route::get('/coordinadores/create', 'CoordinadoresController@create');
Route::get('/coordinadores/{coordinador}', 'CoordinadoresController@show');
Route::post('/coordinadores', 'CoordinadoresController@store');
Route::get('/coordinadores/{coordinador}/change', 'CoordinadoresController@change');
Route::put('/coordinadores/{coordinador}', 'CoordinadoresController@update');
Route::put('/coordinadores/{coordinador}/finalize', 'CoordinadoresController@finalize');
Route::delete('/coordinadores/{coordinador}', 'CoordinadoresController@destroy');
Route::get('/coordinadores/{carrera}/create', 'CoordinadoresController@createfrom');
//Route::get('/coordinadores/{carrera}/list', 'CoordinadoresController@indexfrom');

Route::get('/escuelas', 'EscuelasController@index')->name('escuelas.index');
Route::get('/escuelas/create', 'EscuelasController@create');
Route::get('/escuelas/{escuela}', 'EscuelasController@show');
Route::post('/escuelas', 'EscuelasController@store');
Route::get('/escuelas/{escuela}/edit', 'EscuelasController@edit');
Route::put('/escuelas/{escuela}', 'EscuelasController@update');
Route::delete('/escuelas/{escuela}', 'EscuelasController@destroy');
Route::get('/escuelas/{facultad}/create', 'EscuelasController@createfrom');
Route::get('/escuelas/{facultad}/list', 'EscuelasController@indexfrom');
Route::get('/escuelas/{sede}/list2', 'EscuelasController@indexfromsede');

Route::get('/facultades', 'FacultadesController@index')->name('facultades.index');
Route::get('/facultades/create', 'FacultadesController@create');
Route::get('/facultades/{sede}', 'FacultadesController@show');
Route::post('/facultades', 'FacultadesController@store');
Route::get('/facultades/{facultad}/edit', 'FacultadesController@edit');
Route::put('/facultades/{facultad}', 'FacultadesController@update');
Route::delete('/facultades/{facultad}', 'FacultadesController@destroy');
Route::get('/facultades/{sede}/create', 'FacultadesController@createfrom');
Route::get('/facultades/{sede}/list', 'FacultadesController@indexfrom');

Route::get('/sedes', 'SedesController@index')->name('sedes.index');
Route::get('/sedes/create', 'SedesController@create');
Route::get('/sedes/{sede}', 'SedesController@show');
Route::post('/sedes', 'SedesController@store');
Route::get('/sedes/{sede}/edit', 'SedesController@edit');
Route::put('/sedes/{sede}', 'SedesController@update');
Route::delete('/sedes/{sede}', 'SedesController@destroy');
Route::get('/sedes/{universidad}/create', 'SedesController@createfrom');
Route::get('/sedes/{universidad}/list', 'SedesController@indexfrom');

Route::get('/tutores', 'TutorEsController@index')->name('tutores.index');
Route::get('/tutores/create', 'TutorEsController@create');
Route::get('/tutores/{tutore}', 'TutorEsController@show');
Route::post('/tutores', 'TutorEsController@store');
Route::get('/tutores/{tutore}/edit', 'TutorEsController@edit');

Route::get('/formatos', 'FormatosController@index')->name('formatos.index');
Route::get('/formatos/create', 'FormatosController@create');
Route::get('/formatos/{formato}', 'FormatosController@show');
Route::post('/formatos', 'FormatosController@store');
Route::get('/formatos/{formato}/edit', 'FormatosController@edit');
Route::put('/formatos/{tipodocumento}', 'FormatosController@update');
Route::delete('/formatos/{formato}', 'FormatosController@destroy');
Route::get('/formatos/{formato}/descargar', 'FormatosController@descargar');

Route::get('/convenios', 'ConveniosController@index')->name('convenios.index');
Route::get('/convenios/create', 'ConveniosController@create');
Route::get('/convenios/{convenio}', 'ConveniosController@show');
Route::post('/convenios', 'ConveniosController@store');
Route::get('/convenios/{convenio}/edit', 'ConveniosController@edit');
Route::put('/convenios/{convenio}', 'ConveniosController@update');
Route::delete('/convenios/{convenio}', 'ConveniosController@destroy');
Route::get('/convenios/{convenio}/descargar', 'ConveniosController@descargar');
Route::get('/convenios/{empresa}/create1', 'ConveniosController@createfromempresa');
Route::get('/convenios/{sede}/create', 'ConveniosController@createfrom');
Route::get('/convenios/{sede}/list', 'ConveniosController@indexfrom');

Route::get('/estasignaturas/{carrera}/create/{estudiante}', 'EstudiantexAsignaturaController@create');
Route::post('/estasignaturas', 'EstudiantexAsignaturaController@store');
Route::put('/estasignaturas/{estudiantexAsignatura}', 'EstudiantexAsignaturaController@update');

Route::get('/tutores/{empresa}/create', 'TutorEsController@createfrom');
Route::get('/tutores/{empresa}/list', 'TutorEsController@indexfrom');
Route::put('/tutores/{tutore}', 'TutorEsController@update');
Route::delete('/tutores/{empresa}', 'TutorEsController@destroy');

Route::get('/estudiantes', 'EstudiantesController@index')->name('estudiantes.index');
Route::get('/estudiantes/create', 'EstudiantesController@create');
Route::get('/estudiantes/{estudiante}', 'EstudiantesController@show');
Route::post('/estudiantes', 'EstudiantesController@store');
Route::get('/estudiantes/{estudiante}/edit', 'EstudiantesController@edit');
Route::put('/estudiantes/{estudiante}', 'EstudiantesController@update');
Route::delete('/estudiantes/{estudiante}', 'EstudiantesController@destroy');

Route::get('/practicas', 'PracticasController@index');
Route::get('/practicas/create', 'PracticasController@create');
Route::get('/practicas/{practica}', 'PracticasController@show');
Route::post('/practicas', 'PracticasController@store');
Route::get('/practicas/{practica}/edit', 'PracticasController@edit');
Route::put('/practicas/{practica}', 'PracticasController@update');
Route::put('/practicas/{practica}/finalize', 'PracticasController@finalize');
Route::delete('/practicas/{practica}', 'PracticasController@destroy');
Route::get('/consultas/practicas', 'PracticasController@consultas');
Route::get('/consultas2/practicas', 'PracticasController@consultas2');
Route::get('/practicas/{profesor}/list', 'PracticasController@indexfrom');
Route::get('/practicas/{estudiante}/list2', 'PracticasController@indexfrom2');
Route::get('/practicas/{estudiante}/list3', 'PracticasController@indexfrom3');


Route::get('/reportes', 'ReportesController@index');
Route::post('/reportes/r1', 'ReportesController@reporte1');
Route::get('/reportes/{periodo}/descarga1', 'ReportesController@descargaexcelr1');
Route::post('/reportes/r2', 'ReportesController@reporte2');
Route::post('/reportes/r2p', 'ReportesController@reporte2p');
Route::get('/reportes/{periodo}/descarga2', 'ReportesController@descargaexcelr2');
Route::post('/reportes/r3', 'ReportesController@reporte3');
Route::post('/reportes/r3p', 'ReportesController@reporte3p');
Route::get('/reportes/{tipopractica}/descarga3', 'ReportesController@descargaexcelr3');
Route::post('/reportes/r4', 'ReportesController@reporte4');
Route::post('/reportes/r4p', 'ReportesController@reporte4p');
Route::get('/reportes/{tipoempresa}/descarga4', 'ReportesController@descargaexcelr4');
Route::post('/reportes/r5', 'ReportesController@reporte5');
Route::post('/reportes/r5p', 'ReportesController@reporte5p');
Route::get('/reportes/{sector}/descarga5', 'ReportesController@descargaexcelr5');
Route::post('/reportes/r6', 'ReportesController@reporte6');
Route::post('/reportes/r6p', 'ReportesController@reporte6p');
Route::get('/reportes/{nivel}/descarga6', 'ReportesController@descargaexcelr6');
Route::post('/reportes/r7', 'ReportesController@reporte7');
Route::post('/reportes/{estudiante}/descarga7', 'ReportesController@descargaexcelr7');
Route::post('/reportes/r8', 'ReportesController@reporte8');
Route::post('/reportes/{estudiante}/descarga8', 'ReportesController@descargaexcelr8');
Route::post('/reportes/r9', 'ReportesController@reporte9');
Route::post('/reportes/{profesor}/descarga9', 'ReportesController@descargaexcelr9');
Route::post('/reportes/r10', 'ReportesController@reporte10');
Route::post('/reportes/{estudiante}/descarga9', 'ReportesController@descargaexcelr10');
Route::post('/reportes/r11', 'ReportesController@reporte11');


Route::get('/actividades/{practica}/list', 'ActividadesController@index');
Route::get('/actividades/{practica}/{total}', 'ActividadesController@store');
Route::get('/actividades/{profesor}/create/from', 'ActividadesController@store2');
Route::put('/actividades/{actividad}', 'ActividadesController@update');
Route::post('/actividades/descargar', 'ActividadesController@descargar');


Route::get('/documentos/{practica}/list', 'DocumentosPController@index');
Route::get('/documentos/{documentop}/descargar', 'DocumentosPController@descargar');
Route::post('/documentos', 'DocumentosPController@store');

Route::get('/notifications/{id}','NotificationController@delete');
Route::get('/pulear','sshController@pull');
Route::get('/ayuda','manualController@descargar');