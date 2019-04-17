<?php

namespace App\Http\Controllers;

use App\Sede;
use App\Universidad;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class SedesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sedes = Sede::all();
        return view('sedes.index', compact('sedes'));
    }

    public function create()
    {
        $universidades =Universidad::all();
        return view('sedes.create')->with(compact('universidades'));
    }
    public function indexfrom(Universidad $universidad)
    {
        $sedes = Sede::all()->where('iduniversidad', '=' , $universidad->iduniversidad );
        return view('sedes.index', compact('sedes'));
    }
    public function createfrom(Universidad $universidad)
    {
        $universidades =Universidad::all();
        return view('sedes.create')->with(compact('universidad', 'universidades'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'id'       => 'required',
            'universidad'       => 'required',
            'nombre'       => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Sede::create([
            'idsede'       => request('id'),
            'iduniversidad'       => request('universidad'),
            'nombresede'      => request('nombre'),
            'descripcionsede'      => request('descripcion')
        ]);


        Flash::success('Ingresado Correctamente');
        // redirect
        return ['redirect' => route('sedes.index')];

    }


    public function show(Sede $sede)
    {
        return view('sedes.show')->with('sede', $sede);

    }


    public function edit(Sede $sede)
    {
        $universidades =Universidad::all();
        return view('sedes.edit')->with(compact('sede', 'universidades'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'universidad'       => 'required',
            'nombre'       => 'required',
            'descripcion'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Sede::updateOrCreate(['idsede'  => $id], [
            'iduniversidad'       => request('universidad'),
            'nombresede'      => request('nombre'),
            'descripcionsede'      => request('descripcion')
        ]);


        Flash::success('Actualizado Correctamente');
        // redirect
        return ['redirect' => route('sedes.index')];
    }


    public function destroy($sede)
    {
        Sede::find($sede)
            ->delete();
        Flash::success('Eliminado Correctamente');
        return ['redirect' => route('sedes.index')];
    }
}
