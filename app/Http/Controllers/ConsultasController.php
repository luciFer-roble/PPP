<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Carrera;
use App\Coordinador;
use App\Empresa;
use App\Escuela;
use App\Estudiante;
use App\EstudiantexAsignatura;
use App\Facultad;
use App\Nivel;
use App\PeriodoAcademico;
use App\Practica;
use App\Profesor;
use App\Sede;
use App\TipoDocumento;
use App\TutorE;
use App\Universidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultasController extends Controller
{

    public function listarasignaturas(Request $request)
    {
        $asignaturas = DB::table('carrera')
            ->join('mallascurricular', 'carrera.idcarrera', '=', 'mallascurricular.idcarrera')
            ->join('nivel', 'mallascurricular.idmalla', '=', 'nivel.idmalla')
            ->join('asignatura', 'nivel.idnivel', '=', 'asignatura.idnivel')
            ->where('carrera.idcarrera', 'like', $request->idcarrera)
            ->where('nivel.idnivel', '=', $request->idnivel)
            ->get();
        //var_dump($request->idcarrera.' '.$request->idnivel); exit();
        return $asignaturas;

    }

    public function totaldocs(Request $request){
        return (string)DB::table('tipodocumento')->where('idcarrera', '=', $request->carrera)->count();
    }

    public function todaslaspracticas(){
        $practicas =DB::table('practica')
            ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->orderBy('practica.idpractica', 'desc')
            ->get();
        return $practicas;
    }

    public function consultarpracticas(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where($request->criterio.'.nombres'.$request->criterio, 'like', '%'.$request->parametro.'%')
            ->orWhere($request->criterio.'.apellidos'.$request->criterio, 'like', '%'.$request->parametro.'%')
            ->orWhere($request->criterio.'.nombres'.$request->criterio, 'like', '%'.ucwords(strtolower($request->parametro)).'%')
            ->orWhere($request->criterio.'.apellidos'.$request->criterio, 'like', '%'.ucwords(strtolower($request->parametro)).'%')
            ->orderBy('practica.idpractica', 'desc')
            ->get();
        return $practicas;

    }

    public function consultarpracticasporestudiante(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('practica.idestudiante', '=', request('id'))->get();
        return $practicas;

    }
    public function consultartutoresporempresa(Request $request)
{
    $tutores =DB::table('tutore')
        ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
        ->where('tutore.idempresa', '=', request('idempresa'))->get();
    return $tutores;

}
    public function consultarpracticasporperiodo(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('practica.idperiodoacademico', '=', request('idperiodo'))
            ->where('practica.idestudiante', '=', request('idestudiante'))
            ->get();
        return $practicas;

    }
    public function consultarpracticasportipopractica(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('practica.tipopractica', '=', request('tipopractica'))
            ->where('practica.idestudiante', '=', request('idestudiante'))
            ->get();
        return $practicas;

    }

    public function consultarpracticasportipoempresa(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.tipoempresa', '=', request('tipoempresa'))
            ->where('practica.idestudiante', '=', request('idestudiante'))
            ->get();
        return $practicas;

    }

    public function consultarpracticasporsector(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.sectorempresa', '=', request('sector'))
            ->where('practica.idestudiante', '=', request('idestudiante'))
            ->get();
        return $practicas;

    }

    public function consultarpracticaspornivel(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('practica.idnivel', '=', request('nivel'))
            ->where('practica.idestudiante', '=', request('idestudiante'))
            ->get();
        return $practicas;

    }

    public function totalpracticas()
    {
        return Practica::all()->count();
    }
    public function totalportipo(Request $request)
    {
        return Practica::where('tipopractica','=', Request('tipo'))->count();
    }


    public function totalestudiantesportipoempresa(Request $request)
    {
        $respuesta = Estudiante::select(DB::raw('count(distinct(estudiante.idestudiante)) as totalestudiantes'))
            ->rightJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.tipoempresa', '=', request('tipo'))
            ->groupBy('empresa.tipoempresa')
            ->first();
        //print_r($respuesta); exit();
        return $respuesta;
    }


    public function totalpracticasportipoempresa(Request $request)
    {
        $respuesta = DB::table('practica')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.tipoempresa', '=', request('tipo'))
            ->count();
        //print_r($respuesta); exit();
        return $respuesta;
    }

    public function totalestudiantesporsectorempresa(Request $request)
    {
        $respuesta = 'vacio';
        $total = Estudiante::select(DB::raw('count(distinct(estudiante.idestudiante)) as totalestudiantes'))
            ->rightJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.sectorempresa', '=', request('sector'))
            ->groupBy('empresa.tipoempresa')
            ->first();
        if ($total){
            $respuesta = $total;
        }
        //print_r($respuesta); exit();
        return $respuesta;
    }


    public function totalpracticasporsectorempresa(Request $request)
    {
        $respuesta = DB::table('practica')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.sectorempresa', '=', request('sector'))
            ->count();
        //print_r($respuesta); exit();
        return $respuesta;
    }

    public function totalesporperiodo(){
        $periodos = PeriodoAcademico::all();
        $respuesta=array();
        foreach ($periodos as $periodo){

            $total = Estudiante::select(DB::raw('count(distinct(estudiante.idestudiante)) as totalestudiantes'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->groupBy('estudiante.idestudiante')
                /*->whereDate('fechafinpractica','>=',$periodo->fechainicioperiodoacademico)
                ->whereDate('fechafinpractica','<=',$periodo->fechafinperiodoacademico)*/
                ->havingRaw('SUM(practica.horaspractica) >= 120')
                ->havingRaw("max(practica.fechafinpractica) >= '".$periodo->fechainicioperiodoacademico."'")
                ->havingRaw("max(practica.fechafinpractica) <= '".$periodo->fechafinperiodoacademico."'")
                ->count();
                //var_dump((string)count($total)); exit();
                $respuesta[] = $total;
        }
        //var_dump($respuesta); exit();
        return $respuesta;
    }
    public  function totalperiodos(){

        $periodos = PeriodoAcademico::all();
        return $periodos;
    }

    public function totalespornivel(){
        $niveles = Nivel::all();
        $respuesta=array();
        foreach ($niveles as $nivel){

            $total = Practica::select(DB::raw(' count(distinct(practica.idpractica)) as totalpracticas'))
                ->groupBy('practica.idnivel')
                //->where("practica.idperiodoacademico" ,'=', $periodo->idperiodoacademico)
                ->havingRaw("practica.idnivel = '".$nivel->idnivel."'")
                ->count();
            //var_dump((string)$total);
            $respuesta[] = $total;
        }
        return $respuesta;
    }

    public function totalesporperiodo2(){
        $periodos = PeriodoAcademico::all();
        $respuesta=array();
        foreach ($periodos as $periodo){

            $total = Practica::select(DB::raw(' count(distinct(practica.idpractica)) as totalpracticas'))
                ->groupBy('practica.idperiodoacademico')
                //->where("practica.idperiodoacademico" ,'=', $periodo->idperiodoacademico)
                ->havingRaw("practica.idperiodoacademico = '".$periodo->idperiodoacademico."'")
                ->count();
            //var_dump((string)$total);
            $respuesta[] = $total;
        }
        return $respuesta;
    }
    public  function totalniveles(){
        $niveles = Nivel::all();
        return $niveles;
    }

    public function listarselect1(Request $request)
    {
        if($request->criterio == 'empresa'){
            $lista = Empresa::all();
        }
        else{
            if ($request->criterio == 'periodo'){
                $lista = PeriodoAcademico::with('facultad')->get();
            }
            else{
                $lista = Nivel::all();
            }
        }
        return $lista;
    }
    public function consultarpracticas2(Request $request){
        if($request->criterio == 'empresa'){
            $practicas =DB::table('practica')
                ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
                ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                ->where('empresa.idempresa', '=', $request->parametro)->get();
        }
        else{
            if ($request->criterio == 'periodo'){
                $practicas =DB::table('practica')
                    ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
                    ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                    ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                    ->where('practica.idperiodoacademico', '=', $request->parametro)->get();
            }
            else{
                $estudiantes = DB::select("select estudiante.idestudiante
                from estudiante
                join estudiantexasignatura on estudiantexasignatura.idestudiante = estudiante.idestudiante
                join asignatura on estudiantexasignatura.idasignatura = asignatura.idasignatura
                join nivel on nivel.idnivel = asignatura.idnivel
                group by estudiante.idestudiante
                having min(nivel.idnivel) = '".$request->parametro."'");
                $lista = collect($estudiantes)->map(function($x){ return (array) $x; })->toArray();

                $practicas =DB::table('practica')
                    ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
                    ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                    ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                    ->whereIn('estudiante.idestudiante', $lista)->get();
            }
        }
        return $practicas;
    }
    public function getprofesores(){
        return Profesor::all();
    }
    public function getempresas(){
        return Empresa::all();
    }
    public function getniveles(){
        return Nivel::all();
    }
    public function getperiodos(){
        return PeriodoAcademico::all();
    }
    public function getuniversidades(){
        return Universidad::all();
    }
    public function getasignaturas(Request $request){
        $asignaturas = EstudiantexAsignatura::with('asignatura')
            ->join('asignatura', 'estudiantexasignatura.idasignatura', '=', 'asignatura.idasignatura')
            ->join('nivel', 'nivel.idnivel', '=', 'asignatura.idnivel')
            ->where('idestudiante', $request->idestudiante)
            ->orderBy('nivel.idnivel')
            ->orderBy('asignatura.idasignatura')->get();
        return $asignaturas;
    }
    public function getsedes(){
        return Sede::all();
    }
    public function getfacultades(){
        return Facultad::all();
    }
    public function getescuelas(){
        return Escuela::all();
    }
    public function getcarreras(){
        return Carrera::all();
    }
    public function getcarrerassincoordinador(){
        $carrerasutilizadas = Coordinador::where('activocoordinador','=','TRUE')->pluck('idcarrera');
        return Carrera::whereNotIn('idcarrera', $carrerasutilizadas)->select('idcarrera','nombrecarrera')->get();

    }
    public function getprofesoresnocoordinadores(){
        $profesoresutilizados = Coordinador::where('activocoordinador','=','TRUE')->pluck('idprofesor');
        return Profesor::whereNotIn('idprofesor', $profesoresutilizados)->select('idprofesor','nombresprofesor','apellidosprofesor')->get();

    }
    public function gettutores(Request $request){
        return TutorE::where('idempresa','=', $request->empresa)->get();
    }
    public function getestudiantes(Request $request){
        return Estudiante::where('nombresestudiante','like', '%'.$request->estudiante.'%')
            ->orWhere('apellidosestudiante','like', '%'.$request->estudiante.'%')->get();
    }
    public function getestudiante(Request $request){
        return Estudiante::join('carrera', 'carrera.idcarrera', '=', 'estudiante.idcarrera')
            ->where('idestudiante','=', $request->id)->first();
    }
    public function getempresa(Request $request){
        return Empresa::where('idempresa','=', $request->id)->first();
    }
    public function getprofesor(Request $request){
        return Profesor::join('escuela', 'escuela.idescuela', '=', 'profesor.idescuela')
            ->where('idprofesor','=', $request->id)->first();
    }
    public function gettutore(Request $request){
        return TutorE::join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('idtutore','=', $request->id)->first();
    }
    public function getcarrerauser(Request $request){
        return DB::table('profesor')
            ->join('coordinador', 'profesor.idprofesor', '=', 'coordinador.idprofesor')
            ->join('carrera', 'carrera.idcarrera', '=', 'coordinador.idcarrera')
            ->select('carrera.idcarrera')
            ->where('profesor.iduser', '=',$request->id)
            ->where('coordinador.activocoordinador', '=', 'TRUE')->get();
    }

    public function estudiantes_profesor(Request $request)
    {
        $estudiantes =DB::table('estudiante')
            ->rightJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->select(DB::raw('distinct(estudiante.idestudiante) , estudiante.*'))
            ->where('practica.idprofesor', '=', request('id'))->get();
        return $estudiantes;

    }

    public function actividades_profesor(Request $request)
    {
        $actividades =Actividad::
            where('idprofesor', '=', request('id'))->get();
        return $actividades;

    }

}
