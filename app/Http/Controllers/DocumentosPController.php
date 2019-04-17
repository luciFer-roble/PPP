<?php

namespace App\Http\Controllers;

use App\DocumentoP;
use App\Estudiante;
use App\Practica;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class DocumentosPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Practica $practica)
    {
        $carrera=$practica->estudiante->idcarrera;

        $documentosp = DocumentoP::all()->where('idpractica', '=' , $practica->idpractica );
        $tiposdocumento = TipoDocumento::where('idcarrera','=',$carrera)->get();

        return view('documentos.index', compact('documentosp', 'tiposdocumento', 'practica'));
    }

    public function create()
    {
        $tiposdocumento =TipoDocumento::all();
        $practicas = Practica::all();
        return view('documentos.create')->with(compact('tiposdocumento', 'practicas'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'tipo'       => 'required',
            'practica'       => 'required',
            'archivo'    => 'required',
            'estudiante'  => 'required'
        );
        $this->validate(request(), $rules);

        $file  =   $request->file('archivo');
        $time = date('Y-m-d');

        $name = request('estudiante').request('tipo').'P'.request('practica').'_'.$time.'.'.$file->getClientOriginalExtension();
        // store
        DocumentoP::create([
            'idtipodocumento'       => request('tipo'),
            'idpractica'       => request('practica'),
            'archivodocumentop'      => $name
        ]);

        $path   =   "practicas/";

        $file->storeAs($path, $name);



        //Flash::success('Ingresado Correctamente');

        return $name;

    }


    public function show(DocumentoP $documentop)
    {
        return view('documentosp.show')->with('documentop', $documentop);

    }


    public function edit(DocumentoP $documentop)
    {
        $tiposdocumento =TipoDocumento::all();
        $practicas = Practica::all();
        return view('documentosp.edit')->with(compact('documentop', 'tiposdocumento', 'practicas'));
    }

    public function descargar(DocumentoP $documentop)
    {
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download(storage_path('app/practicas/').$documentop->archivodocumentop, 200, $headers );
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'tipo'       => 'required',
            'practica'       => 'required',
            'archivo'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        DocumentoP::updateOrCreate(['iddocumentop'  => $id], [
            'idtipodocumento'       => request('tipo'),
            'idpractica'       => request('practica'),
            'archivodocumentop'      => request('archivo')
        ]);

        // redirect
        return redirect('documentosp');
    }


    public function destroy($documentop)
    {
        DocumentoP::find($documentop)
            ->delete();

        return redirect('documentosp');
    }
}
