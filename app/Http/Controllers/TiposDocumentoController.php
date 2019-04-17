<?php

namespace App\Http\Controllers;

use App\Formato;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class TiposDocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tiposdocumento = TipoDocumento::all();
        $formatos = Formato::all();
        return view('tiposdocumento.index', compact('tiposdocumento','formatos'));
    }

    public function create()
    {
        return view('tiposdocumento.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'id'       => 'required',
            'descripcion'       => 'required',
            'archivo'       => 'required'
        );
        $this->validate(request(), $rules);


        // store
        TipoDocumento::create([
            'idtipodocumento'       => request('id'),
            'descripciontipodocumento'      => request('descripcion')
        ]);
        Formato::create([
        'idtipodocumento'       => request('id'),
        'archivoformato'      => request('archivo')
        ]);

        Flash::success('Ingresado Correctamente');

        // redirect
        return redirect('tiposdocumento');

    }


    public function show(TipoDocumento $tipodocumento)
    {
        return view('tiposdocumento.show')->with('tipodocumento', $tipodocumento);

    }


    public function edit(Formato $formato)
    {
        return view('tiposdocumento.edit')->with(compact('formato'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'descripcion'       => 'required'
        );
        $this->validate(request(), $rules);


        // store
        TipoDocumento::updateOrCreate(['idtipodocumento'  => $id], [
            'descripciontipodocumento'      => request('descripcion')
        ]);
        Formato::updateOrCreate(['idtipodocumento'  => $id], [
        'archivoformato'      => request('archivo')
         ]);


        Flash::success('Actualizado Correctamente');
        // redirect
        return redirect('tiposdocumento');
    }


    public function destroy($tipodocumento)
    {
        TipoDocumento::find($tipodocumento)
            ->delete();

        return redirect('tiposdocumento');
    }
}
