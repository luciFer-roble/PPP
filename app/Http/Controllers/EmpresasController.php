<?php

namespace App\Http\Controllers;

use App\Convenio;
use App\Sede;
use App\TutorE;
use Illuminate\Http\Request;
use App\Empresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Laracasts\Flash\Flash;

class EmpresasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tutores=TutorE::all();
        $convenios = Convenio::with('sede')->get();
        $empresas = Empresa::orderBy('nombreempresa')->paginate(16);
        return view('empresas.index', compact('empresas', 'convenios','tutores'));
    }
   /* public function index2()
    {
        $empresas = DB::table('empresa')
            ->leftJoin('convenio', 'empresa.idempresa', '=', 'convenio.idempresa')
            ->leftJoin('sede', 'convenio.idsede', '=', 'sede.idsede')
        ->get();
        return view('empresas.coordinador.index', compact('empresas'));
    }*/

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'nombre'       => 'required|max:127|string|unique:empresa,nombreempresa',
            'direccion'    => 'required|max:127|string',
            'sector'       => 'required|max:64|string',
            'telefono'     => 'required|digits_between:7,10',
            'tipo'     => 'required|max:64|string',
            'telefono3'     => 'nullable|digits_between:7,10',
            'responsable'     => 'nullable|max:127|string',
            'telegono2'     => 'nullable|digits_between:7,10'
        );
        $this->validate(request(), $rules);


            // store
            Empresa::create([
                'nombreempresa'       => request('nombre'),
                'direccionempresa'      => request('direccion'),
                'sectorempresa'      => request('sector'),
                'telefonoempresa' => request('telefono'),
                'tipoempresa' => request('tipo'),
                'responsableempresa' => request('responsable'),
                'telefono2empresa' => request('telefono2'),
                'telresponsableempresa' => request('telefono3')
            ]);

            Flash::success('Ingresado Correctamente');
            // redirect
        return ['redirect' => route('empresas.index')];

    }


    public function show(Empresa $empresa)
    {
        return view('empresas.show')->with('empresa', $empresa);

    }


    public function edit(Empresa $empresa)
    {

        return view('empresas.edit')->with('empresa', $empresa);
    }


    public function update(Request $request, $id)
    {
        $nombre = Empresa::where('idempresa', '=', $id)->first();
        $rules = array(
            'nombre' => [
                'required',
                'max:127',
                'string',
                Rule::unique('empresa', 'nombreempresa')->ignore($nombre->nombreempresa, 'nombreempresa'),
            ],
            'direccion'    => 'required|max:127|string',
            'sector'       => 'required|max:64|string',
            'telefono'     => 'required|digits_between:7,10',
            'tipo'     => 'required|max:64|string',
            'telefono3'     => 'nullable|digits_between:7,10',
            'responsable'     => 'nullable|max:127|string',
            'telegono2'     => 'nullable|digits_between:7,10'
        );
        $this->validate(request(), $rules);


        // store
        Empresa::updateOrCreate(['idempresa'  => $id], [
            'nombreempresa'       => request('nombre'),
            'direccionempresa'      => request('direccion'),
            'sectorempresa'      => request('sector'),
            'telefonoempresa' => request('telefono'),
            'tipoempresa' => request('tipo'),
            'responsableempresa' => request('responsable'),
            'telefono2empresa' => request('telefono2'),
            'telresponsableempresa' => request('telefono3')
        ]);


        Flash::success('Actualizado Correctamente');
        // redirect
        return ['redirect' => route('empresas.index')];
    }


    public function destroy($empresa)
    {
        Empresa::find($empresa)
            ->delete();

        return ['redirect' => route('empresas.index')];
    }
}
