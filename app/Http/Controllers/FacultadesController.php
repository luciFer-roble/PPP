<?php

namespace App\Http\Controllers;

use App\Facultad;
use App\Sede;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laracasts\Flash\Flash;

class FacultadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $facultades = Facultad::all();
        return view('facultades.index', compact('facultades'));
    }

    public function create()
    {
        $sedes =Sede::all();
        return view('facultades.create')->with(compact('sedes'));
    }

    public function indexfrom(Sede $sede)
    {
        $facultades = Facultad::all()->where('idsede', '=' , $sede->idsede );
        return view('facultades.index', compact('facultades'));
    }
    public function createfrom(Sede $sede)
    {
        $sedes =Sede::all();
        return view('facultades.create')->with(compact('sede', 'sedes'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'sede'       => 'required',
            'nombre'       => 'required|string|max:30|unique:facultad,facultad.nombrefacultad',
            'mision'       => 'required',
            'vision'    => 'required',
            'descripcion'    => 'required|string|max:300'
        );
        $this->validate(request(), $rules);


        // store
        Facultad::create([
            'idfacultad'       => request('id'),
            'idsede'       => request('sede'),
            'nombrefacultad'      => request('nombre'),
            'misionfacultad'       => request('mision'),
            'visionfacultad'      => request('vision'),
            'descripcionfacultad'      => request('descripcion')
        ]);


        Flash::success('Ingresado Correctamente');
        // redirect
        return ['redirect' => route('facultades.index')];

    }


    public function show(Facultad $facultad)
    {
        return view('facultades.show')->with('facultad', $facultad);

    }


    public function edit(Facultad $facultad)
    {
        $sedes =Sede::all();
        return view('facultades.edit')->with(compact('facultad', 'sedes'));
    }


    public function update(Request $request,$id)
    {
        $facultad=Facultad::where('idfacultad','=',$id)->first();
        $rules = array(
            'sede'       => 'required',
            'nombre'       => [
                'required','string','max:30', Rule::unique('facultad','facultad.nombrefacultad')->ignore($facultad->nombrefacultad, 'nombrefacultad'),],
            'mision'       => 'required',
            'vision'    => 'required',
            'descripcion'    => 'required|string|max:300'
        );
        $this->validate(request(), $rules);


        // store
        Facultad::updateOrCreate(['idfacultad'  => $id], [
            'idsede'       => request('sede'),
            'nombrefacultad'      => request('nombre'),
            'misionfacultad'       => request('mision'),
            'visionfacultad'      => request('vision'),
            'descripcionfacultad'      => request('descripcion')
        ]);

        Flash::success('Actualizado Correctamente');

        return ['redirect' => route('facultades.index')];
    }


    public function destroy($facultad)
    {
        Facultad::find($facultad)
            ->delete();

        return redirect('facultades');
    }
}
