<?php

namespace App\Http\Controllers;

use App\Coordinador;
use App\Escuela;
use App\Practica;
use App\Profesor;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Laracasts\Flash\Flash;

class ProfesoresController extends Controller
{
    use RegistersUsers;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->hasRole('coord')){
            $coordinador=Profesor::all()->where('iduser','=',Auth::user()->id)->first();
            $escuela=$coordinador->idescuela;
            $profesores = Profesor::all()->where('idescuela','=',$escuela);
            $practicas = Practica::all();
            return view('profesores.index', compact('profesores','escuela','practicas'));
        }
        else{
            $profesores = Profesor::all();
            $escuelas = Escuela::all();
            $practicas = Practica::all();
            return view('profesores.index', compact('profesores','escuelas','practicas'));
        }

    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $escuelas =Escuela::all();
        return view('profesores.create')->with(compact('escuelas'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'escuela'       => 'required',
            'cedula'       => 'required|string|unique:profesor,profesor.cedulaprofesor|max:10',
            'nombres'       => 'required|string|max:30',
            'apellidos'    => 'required|string|max:30',
            'celular'    => 'required|digits_between:7,10',
            'correo'    => 'required|email|unique:users,email',
            'oficina'    => 'required|string|max:10'
        );
        $this->validate(request(), $rules);
        $foto='user.jpg';

        $name= request('nombres').' '.request('apellidos');
        $user = User::create([
            'name'     => $name,
            'email'    => request('correo'),
            'password' => bcrypt(request('cedula')),
            'avatar' => $foto,
        ]);
        $user->roles()->attach(Role::where('name','=', 'prof')->first());
        $iduser=$user->id;

        // store
        Profesor::create([
            'idprofesor'       => request('id'),
            'idescuela'       => request('escuela'),
            'nombresprofesor'      => request('nombres'),
            'apellidosprofesor'      => request('apellidos'),
            'correoprofesor'      => request('correo'),
            'oficinaprofesor'      => request('oficina'),
            'celularprofesor'      => request('celular'),
            'cedulaprofesor'      => request('cedula'),
            'iduser'=>$iduser
        ]);


        Flash::success('Ingresado Correctamente');
        // redirect
        return ['redirect' => route('profesores.index')];

    }


    public function show(Profesor $profesor)
    {
        return view('profesores.show')->with('profesor', $profesor);

    }


    public function edit(Profesor $profesor, Request $request)
    {

        $request->user()->authorizeRoles(['admin']);
        $escuelas =Escuela::all();
        return view('profesores.edit')->with(compact('profesor', 'escuelas'));
    }


    public function update(Request $request, $id)
    {
        $profesor=Profesor::where('idprofesor','=',$id)->first();
        $user=User::all()->where('id','=',$profesor->iduser)->first();
        $rules = array(
            'escuela'       => 'required',
            'cedula'       =>[
                'required', Rule::unique('profesor','profesor.cedulaprofesor')->ignore($profesor->cedulaprofesor, 'profesor.cedulaprofesor'),],
            'nombres'       => 'required|string|max:30',
            'apellidos'    => 'required|string|max:30',
            'celular'    => 'required|digits_between:7,10',
            'correo'    =>  [
                'required','email',Rule::unique('users','email')->ignore($user->email,'email'),],
            'oficina'    => 'required|string|max:10'
        );
        $this->validate(request(), $rules);


        // store
        Profesor::updateOrCreate(['idprofesor'  => $id], [
            'idescuela'       => request('escuela'),
            'nombresprofesor'      => request('nombres'),
            'apellidosprofesor'      => request('apellidos'),
            'correoprofesor'      => request('correo'),
            'oficinaprofesor'      => request('oficina'),
            'celularprofesor'      => request('celular'),
            'cedulaprofesor'      => request('cedula')
        ]);


        Flash::success('Actualizado Correctamente');
        // redirect
        return ['redirect' => route('profesores.index')];
    }


    public function destroy($profesor)
    {
        Profesor::find($profesor)
            ->delete();

        return redirect('profesores');
    }
}
