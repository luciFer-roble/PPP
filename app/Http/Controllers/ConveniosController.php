<?php

namespace App\Http\Controllers;

use App\Convenio;
use App\Empresa;
use App\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class ConveniosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sedes = Sede::all();
        $empresas =Empresa::all();
        $convenios = Convenio::all();
        return view('convenios.index', compact('convenios','sedes', 'empresas'));
    }

    public function create()
    {
        $sedes = Sede::all();
        $empresas =Empresa::all();
        return view('convenios.create')->with(compact('sedes', 'empresas'));
    }

    public function indexfrom(Sede $sede)
    {
        $convenios = Convenio::all()->where('idsede', '=' , $sede->idsede );
        return view('convenios.index', compact('convenios'));
    }
    public function createfrom(Sede $sede)
    {
        $sedes =Sede::all();
        $empresas =Empresa::all();
        return view('convenios.create')->with(compact('sede', 'sedes','empresas'));
    }
    public function createfromempresa(Empresa $empresa)
    {
        $sedes =Sede::all();
        $empresas =Empresa::all();
        return view('convenios.create')->with(compact('empresa', 'empresas','sedes'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'id'           =>'required|max:10|alpha_dash|unique:convenio,idconvenio',
            'sede'       => 'required',
            'empresa'       => 'required',
            'descripcion'    => 'required|max:255|string',
            'inicio'       => 'required|date',
            'fin'       => 'required|date',
            'archivo'       => 'required|file'
        );
        $this->validate(request(), $rules);

        $file  =   $request->file('archivo');

        $name = request('id').'.'.$file->getClientOriginalExtension();

        // store
        Convenio::create([
            'idconvenio'       => request('id'),
            'idsede'       => request('sede'),
            'idempresa'       => request('empresa'),
            'descripcionconvenio'      => request('descripcion'),
            'fechainicioconvenio'      => request('inicio'),
            'fechafinconvenio' => request('fin'),
            'archivoconvenio' => $name
        ]);
        $path   =   "convenios/";

        $file->storeAs($path, $name);

        Flash::success('Ingresado Correctamente');
        // redirect
        if($request->page === 'empresas'){
            return ['redirect' => route('empresas.index')];
        }else{
            return ['redirect' => route('convenios.index')];
        }

    }

    public function descargar(Convenio $convenio)
    {
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download(storage_path('app/convenios/').$convenio->archivoconvenio, 200, $headers );
    }
    public function show(Convenio $convenio)
    {
        return view('convenios.show')->with('convenio', $convenio);

    }


    public function edit(Convenio $convenio)
    {
        $sedes = Sede::all();
        $empresas =Empresa::all();
        return view('convenios.edit')->with(compact('convenio', 'sedes', 'empresas'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'sede'       => 'required',
            'empresa'       => 'required',
            'descripcion'    => 'required|max:255|alpha_dash',
            'inicio'       => 'required|date',
            'fin'       => 'required|date'
        );
        $this->validate(request(), $rules);
        $file  =   $request->file('archivo');

        if($file <> null){
            $name = request('id').'.'.$file->getClientOriginalExtension();
            $nameorigin= DB::table('convenio')->select('archivoconvenio')->where('idconvenio', $id)->first();
            Convenio::updateOrCreate(['idconvenio'  => $id], [
                'idsede'       => request('sede'),
                'idempresa'       => request('empresa'),
                'descripcionconvenio'      => request('descripcion'),
                'fechainicioconvenio'      => request('inicio'),
                'fechafinconvenio' => request('fin'),
                'archivoconvenio' => $name
            ]);
            $path   =   "convenios/";
            Storage::disk('convenios')->delete($nameorigin->archivoconvenio);
            $file->storeAs($path, $name);
        }


         else{
             Convenio::updateOrCreate(['idconvenio'  => $id], [
                 'idsede'       => request('sede'),
                 'idempresa'       => request('empresa'),
                 'descripcionconvenio'      => request('descripcion'),
                 'fechainicioconvenio'      => request('inicio'),
                 'fechafinconvenio' => request('fin')
                 //'archivoconvenio' => $name
             ]);
         }

        Flash::success('Actualizado Correctamente');
        // redirect
        return ['redirect' => route('convenios.index')];
    }


    public function destroy($convenio)
    {
        Convenio::find($convenio)
            ->delete();

        return redirect('convenios');
    }
}
