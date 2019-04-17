<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\TutorE;
use App\Empresa;
use Laracasts\Flash\Flash;

class TutorEsController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tutores = TutorE::all();
        return view('tutores.index', compact('tutores'));
    }

    public function indexfrom(Empresa $empresa)
    {
        $tutores = TutorE::all()->where('idempresa', '=' , $empresa->idempresa );
        return view('tutores.index', compact('tutores'));
    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $empresas =Empresa::all();
        return view('tutores.create')->with(compact('empresas'));
    }
    public function createfrom(Empresa $empresa, Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $empresas =Empresa::all();
        return view('tutores.create')->with(compact('empresa', 'empresas'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'empresa'       => 'required',
            'nombre'       => 'required|max:32|string',
            'apellido'    => 'required|max:32|string',
            'celular'       => 'nullable|digits_between:7,10',
            'correo'    => 'required|email|unique:users,email',
            'cedula'    => 'required|digits:10'
        );
        $this->validate(request(), $rules);
        $foto='user.jpg';

        $name= request('nombre').' '.request('apellido');
        $user = User::create([
            'name'     => $name,
            'email'    => request('correo'),
            'password' => bcrypt(request('cedula')),
            'avatar' => $foto,
        ]);
        $user->roles()->attach(Role::where('name','=', 'tut')->first());
        $iduser=$user->id;

        // store
        TutorE::create([
            'idempresa'       => request('empresa'),
            'nombretutore'       => request('nombre'),
            'apellidotutore'      => request('apellido'),
            'celulartutore'      => request('celular'),
            'correotutore' => request('correo'),
            'iduser'=> $iduser
        ]);


        Flash::success('Ingresado Correctamente');
        // redirect
        if($request->page === 'empresas'){
            return ['redirect' => route('empresas.index')];
        }else{
            return ['redirect' => route('tutores.index')];
        }

    }


    public function show(TutorE $tutore)
    {
        return view('tutores.show')->with('tutore', $tutore);

    }


    public function edit(TutorE $tutore, Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $empresas =Empresa::all();
        return view('tutores.edit')->with(compact('tutore', 'empresas'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'empresa'       => 'required',
            'nombre'       => 'required|max:32|string',
            'apellido'    => 'required|max:32|string',
            'celular'       => 'nullable|digits_between:7,10'
        );
        $this->validate(request(), $rules);


        // store
        TutorE::updateOrCreate(['idtutore'  => $id], [
            'idempresa'       => request('empresa'),
            'nombretutore'       => request('nombre'),
            'apellidotutore'      => request('apellido'),
            'celulartutore'      => request('celular')
        ]);

        Flash::success('Actualizado Correctamente');

        // redirect
        return ['redirect' => route('tutores.index')];
    }


    public function destroy($tutore)
    {
        TutorE::find($tutore)
            ->delete();

        return redirect('tutores');
    }
}
