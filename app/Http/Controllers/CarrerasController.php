<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Escuela;
use App\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class CarrerasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $carreras = Carrera::all();
        return view('carreras.index', compact('carreras'));
    }
    public function indexfrom(Escuela $escuela)
    {
        $carreras = Carrera::all()->where('idescuela', '=' , $escuela->idescuela );
        return view('carreras.index', compact('carreras'));
    }
    public function indexfromsede(Sede $sede)
    {
        $carreras = DB::table('carrera')
            ->join('escuela', 'escuela.idescuela', '=', 'carrera.idescuela')
            ->join('facultad', 'escuela.idfacultad', '=', 'facultad.idfacultad')
            ->join('sede', 'facultad.idsede', '=', 'sede.idsede')
            ->where('sede.idsede', $sede->idsede)
            ->get();
        //$carreras = Carrera::all()->whereIn('idescuela',$escuelas)->get();
        return view('carreras.index', compact('carreras'));
    }
    public function createfrom(Escuela $escuela)
    {
        $escuelas =Escuela::all();
        return view('carreras.create')->with(compact('escuela', 'escuelas'));
    }
    public function create()
    {
        $escuelas =Escuela::all();
        return view('carreras.create')->with(compact('escuelas'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'id'           =>'required|max:10|alpha_dash|unique:carrera,idcarrera',
            'escuela'       => 'required',
            'nombre'       => 'required|max:100|string',
            'descripcion'    => 'nullable|max:300|string'
        );
        $this->validate(request(), $rules);


        // store
        Carrera::create([
            'idcarrera'       => request('id'),
            'idescuela'       => request('escuela'),
            'nombrecarrera'       => request('nombre'),
            'descripcioncarrera'      => request('descripcion')
        ]);


        Flash::success('Ingresado Correctamente');
        // redirect
        return ['redirect' => route('carreras.index')];

    }


    public function show(Carrera $carrera)
    {
        return view('carreras.show')->with('carrera', $carrera);

    }


    public function edit(Carrera $carrera)
    {
        $escuelas =Escuela::all();
        return view('carreras.edit')->with(compact('carrera', 'escuelas'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'escuela'       => 'required',
            'nombre'       => 'required|max:100|string',
            'descripcion'    => 'nullable|max:300|string'
        );
        $this->validate(request(), $rules);


        // store
        Carrera::updateOrCreate(['idcarrera'  => $id], [
            'idescuela'       => request('escuela'),
            'nombrecarrera'       => request('nombre'),
            'descripcioncarrera'      => request('descripcion')
        ]);


        Flash::success('Actualizado Correctamente');
        // redirect
        return ['redirect' => route('carreras.index')];
    }


    public function destroy($carrera)
    {
        Carrera::find($carrera)
            ->delete();

        return redirect('carreras');
    }
}
