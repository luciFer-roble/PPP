<?php

namespace App\Http\Controllers;

use App\Formato;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class FormatosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->hasRole('admin') or Auth::user()->hasRole('tut')){
            $formatos = Formato::
                join('tipodocumento', 'formato.idtipodocumento', '=', 'tipodocumento.idtipodocumento')
                ->join('carrera', 'carrera.idcarrera', '=', 'tipodocumento.idcarrera')
                ->orderby('idformato')->get();
        }
        elseif(Auth::user()->hasRole('coord')){
            $carrera = DB::table('profesor')
                ->join('coordinador', 'profesor.idprofesor', '=', 'coordinador.idprofesor')
                ->join('carrera', 'carrera.idcarrera', '=', 'coordinador.idcarrera')
                ->select('carrera.idcarrera')
                ->where('profesor.iduser', '=', Auth::user()->id)
                ->where('coordinador.activocoordinador', '=', 'TRUE');
            //var_dump($carrera); exit();
            $formatos = Formato::
                join('tipodocumento', 'formato.idtipodocumento', '=', 'tipodocumento.idtipodocumento')
                ->join('carrera', 'carrera.idcarrera', '=', 'tipodocumento.idcarrera')
                ->whereIn('carrera.idcarrera', $carrera)
                ->orderby('idformato')->get();
            //var_dump($formatos); exit();
        }
        elseif(Auth::user()->hasRole('prof')){
            $carrera = DB::table('profesor')
                ->join('escuela', 'profesor.idescuela', '=', 'escuela.idescuela')
                ->join('carrera', 'carrera.idescuela', '=', 'escuela.idescuela')
                ->select('carrera.idcarrera')
                ->where('profesor.iduser', '=', Auth::user()->id);
            //var_dump($carrera); exit();
            $formatos = Formato::
                join('tipodocumento', 'formato.idtipodocumento', '=', 'tipodocumento.idtipodocumento')
                ->join('carrera', 'carrera.idcarrera', '=', 'tipodocumento.idcarrera')
                ->whereIn('carrera.idcarrera', $carrera)
                ->orderby('idformato')->get();
            //var_dump($formatos); exit();
        }
        elseif(Auth::user()->hasRole('est')){
            $carrera = DB::table('estudiante')
                ->join('carrera', 'carrera.idcarrera', '=', 'estudiante.idcarrera')
                ->select('carrera.idcarrera')
                ->where('estudiante.iduser', '=', Auth::user()->id);
            //var_dump($carrera); exit();
            $formatos = Formato::
                join('tipodocumento', 'formato.idtipodocumento', '=', 'tipodocumento.idtipodocumento')
                ->join('carrera', 'carrera.idcarrera', '=', 'tipodocumento.idcarrera')
                ->whereIn('carrera.idcarrera', $carrera)
                ->orderby('idformato')->get();
            //var_dump($formatos); exit();
        }
        $tiposdocumento = TipoDocumento::orderby('idtipodocumento')->get();
        return view('formatos.index', compact('tiposdocumento','formatos'));
    }

    public function create()
    {
        return view('formatos.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'id'       => 'required|unique:tipodocumento,tipodocumento.idtipodocumento|max:10|alpha_dash',
            'descripcion'       => 'required|string|max:128',
            'archivo'       => 'required',
            'carrera'      => 'required'
        );
        $this->validate(request(), $rules);

        $file  =   $request->file('archivo');

        $name = request('id').'.'.$file->getClientOriginalExtension();


        // store
        TipoDocumento::create([
            'idtipodocumento'       => request('id'),
            'descripciontipodocumento'      => request('descripcion'),
            'idcarrera'      => request('carrera')
        ]);
        Formato::create([
            'idtipodocumento'       => request('id'),
            'archivoformato'      => $name
        ]);

        $path   =   "formatos/";

        $file->storeAs($path, $name);


        Flash::success('Ingresado Correctamente');
        // redirect

        return ['redirect' => route('formatos.index')];

    }


    public function show(Formatos $formato)
    {
        return view('formatos.show')->with('formato', $formato);

    }


    public function edit(Formato $formato)
    {
        return view('formatos.edit')->with(compact('formato','tipodocumento'));
    }

    public function descargar(Formato $formato)
    {
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download(storage_path('app/formatos/').$formato->archivoformato, 200, $headers );
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'id'       => 'required',
            'descripcion'       => 'required|string|max:128'
        );
        $this->validate(request(), $rules);
        //var_dump($request->descripcion); exit();
        $file  =   $request->file('archivo');

        if($file<>null){
            $name = request('id').'.'.$file->getClientOriginalExtension();
            $nameorigin= DB::table('formato')->select('archivoformato')->where('idtipodocumento', $id)->first();

            // store
            TipoDocumento::updateOrCreate(['idtipodocumento'  => $id], [
                'descripciontipodocumento'      => request('descripcion')
            ]);/*
        Formato::updateOrCreate(['idtipodocumento'  => $id], [
            'archivoformato'      => request('archivo')
        ]);*/
            DB::table('formato')
                ->where('idtipodocumento', $id)
                ->update(['archivoformato' => $name]);

            $path   =   "formatos/";
            Storage::disk('formatos')->delete($nameorigin->archivoformato);
            $file->storeAs($path, $name);
        }
        else{
            TipoDocumento::updateOrCreate(['idtipodocumento'  => $id], [
                'descripciontipodocumento'      => request('descripcion')
            ]);
        }

        Flash::success('Actualizado Correctamente');

        // redirect
        return ['redirect' => route('formatos.index')];
    }


    public function destroy($formato)
    {

        $tipo = Formato::where('idformato', '=', $formato)->first();
        Formato::find($formato)
        ->delete();
        //var_dump($formato.' '.$tipo->idtipodocumento); exit();
        TipoDocumento::find($tipo->idtipodocumento)
        ->delete();

        return ['redirect' => route('formatos.index')];
    }
}
