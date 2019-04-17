<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Profesor;
use App\TutorE;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use Intervention\Image\File;
use Laracasts\Flash\Flash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {
        if(Auth::user()->hasRole('admin')){
            return view('users.show')->with('user', $user);
        }
        elseif(Auth::user()->hasRole('prof') or Auth::user()->hasRole('coord') ){
        $usuario = DB::table('profesor')
            ->leftJoin('users', 'users.id', '=', 'profesor.iduser')
            ->select('users.*','profesor.nombresprofesor as nombre','profesor.apellidosprofesor as apellido', 
                'profesor.correoprofesor as correo', 'profesor.celularprofesor as celular')
            ->where('iduser','=',$user->id)
            ->first();
        }
        elseif(Auth::user()->hasRole('est')){
            $usuario = DB::table('estudiante')
                ->leftJoin('users', 'users.id', '=', 'estudiante.iduser')
                ->select('users.*','estudiante.nombresestudiante as nombre','estudiante.apellidosestudiante as apellido',
                    'estudiante.correoestudiante as correo', 'estudiante.celularestudiante as celular')
                ->where('iduser','=',$user->id)
                ->first();
        }
        elseif(Auth::user()->hasRole('tut')){

            $usuario = DB::table('tutore')
                ->leftJoin('users', 'users.id', '=', 'tutore.iduser')
                ->select('users.*','tutore.nombretutore as nombre','tutore.apellidotutore as apellido',
                    'tutore.correotutore as correo', 'tutore.celulartutore as celular')
                ->where('iduser','=',$user->id)
                ->first();
        }

        return view('users.show')->with('usuario', $usuario);

    }


    public function edit()
    {

    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'foto'    => 'image'

        );
        $this->validate(request(), $rules);
        if(!empty(request('foto'))){
            $image  =   $request->file('foto');

            $user=User::all()->where('id','=',$id)->first();
            if($user->avatar!='user.jpg'){
                $oldavatar=public_path('/uploads/avatars/'.$user->avatar);
                unlink($oldavatar);
            }

            $nameimage = $id.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path('/uploads/avatars/'.$nameimage));

            User::updateOrCreate(['id'  => $id], [
                'avatar'      => $nameimage,
                'email' =>request('correo')
            ]);
        }
        else{
            User::updateOrCreate(['id'  => $id], [
            'email' =>request('correo')
        ]);

        }     

        if(Auth::user()->hasRole('tut')){
            $tutore=TutorE::all()->where('iduser','=',$id)->first();
            TutorE::updateOrCreate(['idtutore'  => $tutore->idtutore], [
                'celulartutore'      => request('celular'),
                'correotutore' => request('correo')
            ]);
        }
        if(Auth::user()->hasRole('est')){
            $estudiante=Estudiante::all()->where('iduser','=',$id)->first();
            Estudiante::updateOrCreate(['idestudiante'  => $estudiante->idestudiante], [
                'celularestudiante'      => request('celular'),
                'correoestudiante' => request('correo')
            ]);
        }
        if(Auth::user()->hasRole('prof') or Auth::user()->hasRole('coord')) {
            $profesor=Profesor::all()->where('iduser','=',$id)->first();
            Profesor::updateOrCreate(['idprofesor'  => $profesor->idprofesor], [
                'celularprofesor'      => request('celular'),
                'correoprofesor' => request('correo')
            ]);
        }
        Flash::success('Actualizado Correctamente');
        return back();
    }


    public function destroy($id)
    {
        //
    }
}
