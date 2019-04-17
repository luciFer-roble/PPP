<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Nivel;
use App\PeriodoAcademico;
use App\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('coord')){
            $periodos = PeriodoAcademico::all();
            $niveles = Nivel::all();
            $estudiantes = Estudiante::all();
            $profesores = Profesor::all();
            return view('reportes.index', compact('estudiantes', 'niveles', 'periodos', 'profesores'));
        }else{
            return view('home');
        }
    }
}
