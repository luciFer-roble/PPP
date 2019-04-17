<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Coordinador;
use App\Profesor;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use function Symfony\Component\VarDumper\Tests\Fixtures\bar;
use Laracasts\Flash\Flash;

class CoordinadoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $coordinadores = Coordinador::all( )->where('activocoordinador','=','TRUE');
        return view('coordinadores.index', compact('coordinadores'));
    }

    public function create()
    {
        $carrerasutilizadas = Coordinador::where('activocoordinador','=','TRUE')->pluck('idcarrera');
        $carreras = Carrera::whereNotIn('idcarrera', $carrerasutilizadas)->select('idcarrera','nombrecarrera')->get();
        $profesoresutilizados = Coordinador::where('activocoordinador','=','TRUE')->pluck('idprofesor');
        $profesores= Profesor::whereNotIn('idprofesor', $profesoresutilizados)->select('idprofesor','nombresprofesor', 'apellidosprofesor')->get();

        return view('coordinadores.create')->with(compact('carreras', 'profesores'));
    }
    public function change(Coordinador $coordinador)
    {
        $carreras =Carrera::all();
        $profesores = Profesor::all();
        return view('coordinadores.change')->with(compact('coordinador', 'carreras', 'profesores'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'carrera'       => 'required',
            'profesor'       => 'required',
            'inicio'    => 'required|date',
            'fin'    => 'date'
        );
        $this->validate(request(), $rules);
        $idprofesor=request('profesor');
        $activo='TRUE';
        // store
        Coordinador::create([
            'idcarrera'       => request('carrera'),
            'idprofesor'       => request('profesor'),
            'fechainiciocoordinador'      => request('inicio'),
            'fechafincoordinador'      => request('fin'),
            'activocoordinador'      => $activo
        ]);
        $profesor=Profesor::where('idprofesor','=',$idprofesor)->first();
        $user=User::where('id','=',$profesor->iduser)->first();
        $user->roles()->detach();
        $user->roles()->attach(Role::where('name','=', 'coord')->first());

        if(!empty(request('cambio'))){
            $id=request('cambio');
            return $this->finalize($id);
        }
        else{

            Flash::success('Ingresado Correctamente');
            // redirect
            return ['redirect' => route('coordinadores.index')];

        }



    }


    public function show(Coordinador $coordinador)
    {
        return view('coordinadores.show')->with('coordinador', $coordinador);

    }


    public function edit(Coordinador $coordinador)
    {
        $carreras =Carrera::all();
        $profesores = Profesor::all();
        return view('coordinadores.edit')->with(compact('coordinador', 'carreras', 'profesores'));
    }



    /*public function update(Request $request, $id)
    {
        $rules = array(
            'carrera'       => 'required',
            'profesor'       => 'required',
            'inicio'    => 'required',
            'fin'    => 'required',
            'activo'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Coordinador::updateOrCreate(['idcoordinador'  => $id], [
            'idcarrera'       => request('carrera'),
            'idprofesor'       => request('profesor'),
            'fechainiciocoordinador'      => request('inicio'),
            'fechafincoordinador'      => request('fin'),
            'activocoordinador'      => request('activo')
        ]);


        // redirect
        return redirect('coordinadores');
    }*/
    public function update($id)
    {
        $rules = array(
            'fin'    => 'required|date',
            'inicio'    => 'date'

        );
        $this->validate(request(), $rules);
        // store
        Coordinador::updateOrCreate(['idcoordinador'  => $id], [
            'fechafincoordinador'      => request('fin'),
            'fechainiciocoordinador'      => request('inicio')
        ]);

        Flash::success('Actualizado Correctamente');

        return ['redirect' => route('coordinadores.index')];


    }
    public function finalize($id)
    {
        $rules = array(
            'fin'    => 'required|date',
            'inicio' => 'required|date'

        );
        $this->validate(request(), $rules);
        $coordinador=Coordinador::where('idcoordinador','=',$id)->first();
        $activo='FALSE';
        // store
        Coordinador::updateOrCreate(['idcoordinador'  => $id], [
            'fechafincoordinador'      => request('fin'),
            'fechainiciocoordinador'      => request('inicio'),
            'activocoordinador'      => $activo
        ]);

        $profesor=Profesor::where('idprofesor','=',$coordinador->idprofesor)->first();
        $user=User::where('id','=',$profesor->iduser)->first();
        $user->roles()->detach();
        $user->roles()->attach(Role::where('name','=', 'prof')->first());

        Flash::success('Actualizado Correctamente');

        return ['redirect' => route('coordinadores.index')];


    }


    public function destroy($coordinador)
    {
        Coordinador::find($coordinador)
            ->delete();

        return redirect('coordinadores');
    }
}
