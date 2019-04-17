<?php

namespace App\Http\Controllers;

use App\Escuela;
use App\Facultad;
use App\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class EscuelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $escuelas = Escuela::all();
        return view('escuelas.index', compact('escuelas'));
    }

    public function create()
    {
        $facultades =Facultad::all();
        return view('escuelas.create')->with(compact('facultades'));
    }
    public function indexfrom(Facultad $facultad)
    {
        $escuelas = Escuela::all()->where('idfacultad', '=' , $facultad->idfacultad );
        return view('escuelas.index', compact('escuelas'));
    }
    public function indexfromsede(Sede $sede)
    {

        $escuelas = DB::table('escuela')
            ->join('facultad', 'escuela.idfacultad', '=', 'facultad.idfacultad')
            ->join('sede', 'facultad.idsede', '=', 'sede.idsede')
            ->where('sede.idsede', $sede->idsede)
            ->get();
        return view('escuelas.index', compact('escuelas'));
    }
    public function createfrom(Facultad $facultad)
    {
        $facultades =Facultad::all();
        return view('escuelas.create')->with(compact('facultad', 'facultades'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'id'           =>'required|max:10|alpha_dash|unique:escuela,idescuela',
            'facultad'       => 'required',
            'nombre'       => 'required|string|max:30',
            'descripcion'       => 'nullable|string|max:300',
            'titulacion'    => 'nullable|string',
            'mision'    => 'nullable|string',
            'vision'    => 'nullable|string',
            'duracion'    => 'required|integer|max:12',
            'modalidad'    => 'required|string|max:30',
            'campo'    => 'nullable|string|max:30',
            'titulo'    => 'nullable|string|max:30'
        );
        $this->validate(request(), $rules);


        // store
        Escuela::create([
            'idescuela'       => request('id'),
            'idfacultad'       => request('facultad'),
            'nombreescuela'       => request('nombre'),
            'descripcionescuela'      => request('descripcion'),
            'titulacionescuela'      => request('titulacion'),
            'misionescuela'      => request('mision'),
            'visionescuela'      => request('vision'),
            'duracionescuela'      => request('duracion'),
            'modalidadescuela'      => request('modalidad'),
            'campoescuela'      => request('campo'),
            'tituloescuela'      => request('titulo')
        ]);


        Flash::success('Ingresado Correctamente');
        // redirect
        return ['redirect' => route('escuelas.index')];

    }


    public function show(Escuela $escuela)
    {
        return view('escuelas.show')->with('escuela', $escuela);

    }


    public function edit(Escuela $escuela)
    {
        $facultades =Facultad::all();
        return view('escuelas.edit')->with(compact('escuela', 'facultades'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'facultad'       => 'required',
            'nombre'       => 'required|string|max:30',
            'descripcion'       => 'nullable|string|max:300',
            'titulacion'    => 'nullable|string',
            'mision'    => 'nullable|string',
            'vision'    => 'nullable|string',
            'duracion'    => 'required|integer|max:12',
            'modalidad'    => 'required|string|max:30',
            'campo'    => 'nullable|string|max:30',
            'titulo'    => 'nullable|string|max:30'
        );
        $this->validate(request(), $rules);


        // store
        Escuela::updateOrCreate(['idescuela'  => $id], [
            'idfacultad'       => request('facultad'),
            'nombreescuela'       => request('nombre'),
            'descripcionescuela'      => request('descripcion'),
            'titulacionescuela'      => request('titulacion'),
            'misionescuela'      => request('mision'),
            'visionescuela'      => request('vision'),
            'duracionescuela'      => request('duracion'),
            'modalidadescuela'      => request('modalidad'),
            'campoescuela'      => request('campo'),
            'tituloescuela'      => request('titulo')
        ]);


        Flash::success('Actualizado Correctamente');
        // redirect
        return ['redirect' => route('escuelas.index')];
    }


    public function destroy($escuela)
    {
        Escuela::find($escuela)
            ->delete();

        return redirect('escuelas');
    }
}
