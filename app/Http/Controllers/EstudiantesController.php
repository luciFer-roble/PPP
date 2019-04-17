<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Escuela;
use App\Estudiante;
use App\Facultad;
use App\Practica;
use App\Profesor;
use App\Role;
use App\Sede;
use App\TutorE;
use App\User;
use DB;
use Illuminate\Validation\Rule;
use Image;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class EstudiantesController extends Controller
{
    use RegistersUsers;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $carreras =Carrera::all();
        $escuelas =Escuela::all();
        $facultades =Facultad::all();
        $sedes =Sede::all();
        if(Auth::user()->hasRole('prof')){
            $profesor = Profesor::all()->where('iduser','=',Auth::user()->id)->first();
            $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->whereHas('practica', function($query) {
                    $query->where('practica.activapractica', 'TRUE');
                })
                ->where('practica.idprofesor','=',$profesor->idprofesor)
                ->groupBy('estudiante.idestudiante')
                ->havingRaw('SUM(practica.horaspractica) > 0')
                ->orderByRaw('SUM(practica.horaspractica)')
                ->get();
            $estudiantes2 = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->whereDoesntHave('practica', function($query) {
                    $query->where('practica.activapractica', 'TRUE');
                })
                ->where('practica.idprofesor','=',$profesor->idprofesor)
                ->groupBy('estudiante.idestudiante')
                ->orderByRaw('SUM(practica.horaspractica) ASC')
                ->get();
            return view('estudiantes.index', compact('estudiantes', 'estudiantes2', 'carreras', 'escuelas', 'facultades', 'sedes'));

        }
        elseif (Auth::user()->hasRole('tut')){
            $tutore = Tutore::all()->where('iduser','=',Auth::user()->id)->first();
            $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->whereHas('practica', function($query) {
                    $query->where('practica.activapractica', 'TRUE');
                })
                ->where('practica.idtutore','=',$tutore->idtutore)
                ->groupBy('estudiante.idestudiante')
                ->havingRaw('SUM(practica.horaspractica) > 0')
                ->orderByRaw('SUM(practica.horaspractica)')
                ->get();
            $estudiantes2 = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->whereDoesntHave('practica', function($query) {
                    $query->where('practica.activapractica', 'TRUE');
                })
                ->where('practica.idtutore','=',$tutore->idtutore)
                ->groupBy('estudiante.idestudiante')
                ->orderByRaw('SUM(practica.horaspractica) ASC')
                ->get();
            return view('estudiantes.index', compact('estudiantes', 'estudiantes2', 'carreras', 'escuelas', 'facultades', 'sedes'));

        }
        elseif (Auth::user()->hasRole('coord')){
            $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->whereHas('practica', function($query) {
                    $query->where('practica.activapractica', 'TRUE');
                        })
                ->groupBy('estudiante.idestudiante')
                ->havingRaw('SUM(practica.horaspractica) > 0')
                ->orderByRaw('SUM(practica.horaspractica)')
                ->get();
            $estudiantes2 = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->whereDoesntHave('practica', function($query) {
                    $query->where('practica.activapractica', 'TRUE');
                })
                ->groupBy('estudiante.idestudiante')
                ->orderByRaw('SUM(practica.horaspractica) ASC')
                ->get();
            return view('estudiantes.index', compact('estudiantes', 'estudiantes2', 'carreras', 'escuelas', 'facultades', 'sedes'));


        }
        else{
            $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->groupBy('estudiante.idestudiante')
                ->get();
        }
        return view('estudiantes.index', compact('estudiantes', 'carreras', 'escuelas', 'facultades', 'sedes'));
    }

    public function create(Request $request)
    {

        $request->user()->authorizeRoles(['admin']);
        $carreras =Carrera::all();
        $escuelas =Escuela::all();
        $facultades =Facultad::all();
        $sedes =Sede::all();
        return view('estudiantes.create')->with(compact('carreras', 'escuelas', 'facultades', 'sedes'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'carrera'       => 'required',
            'cedula'       => 'required|string|unique:estudiante,estudiante.cedulaestudiante|max:10',
            'nombres'       => 'required|string|max:30',
            'apellidos'    => 'required|string|max:30',
            'tipo'    => 'required',
            'celular'    => 'required|digits_between:7,10',
            'correo'    => 'required|email|unique:users,email',
            'fechanacimiento'    => 'required',
            'genero'    => 'required'

        );
        $this->validate(request(), $rules);

        $nameimage="user.jpg";
        $name= request('nombres').' '.request('apellidos');
        $user = User::create([
            'name'     => $name,
            'email'    => request('correo'),
            'password' => bcrypt(request('cedula')),
            'avatar' => $nameimage
        ]);
        $user->roles()->attach(Role::where('name','=', 'est')->first());
        $iduser=$user->id;
        // store
        Estudiante::create([
            'idestudiante'       => request('cedula'),
            'idcarrera'       => request('carrera'),
            'cedulaestudiante'       => request('cedula'),
            'nombresestudiante'      => request('nombres'),
            'apellidosestudiante'      => request('apellidos'),
            'tipoestudiante'      => request('tipo'),
            'correoestudiante'      => request('correo'),
            'celularestudiante'      => request('celular'),
            'fechanacimientoestudiante'      => request('fechanacimiento'),
            'generoestudiante'      => request('genero'),
            'iduser'=>$iduser
        ]);



        Flash::success('Ingresado Correctamente');
        // redirect
        return redirect('estudiantes');

    }
    public function descargar(Estudiante $estudiante)
    {
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download(storage_path('app/convenios/').$estudiante->fotoestudiante, 200, $headers );
    }

    public function show(Estudiante $estudiante)
    {
        return view('estudiantes.show')->with('estudiante', $estudiante);

    }


    public function edit(Estudiante $estudiante,Request $request)
    {

        $request->user()->authorizeRoles(['admin']);
        $carreras =Carrera::all();
        $escuelas =Escuela::all();
        $facultades =Facultad::all();
        $sedes =Sede::all();
        return view('estudiantes.edit')->with(compact('estudiante', 'carreras', 'escuelas', 'facultades', 'sedes'));
    }


    public function update(Request $request, $id)
    {
        $estudiante=Estudiante::all()->where('idestudiante','=',$id)->first();
        $user=User::all()->where('id','=',$estudiante->iduser)->first();
        $rules = array(
            'carrera'       => 'required',
            'cedula'       =>  [
                'nullable', Rule::unique('estudiante','estudiante.cedulaestudiante')->ignore($id, 'estudiante.cedulaestudiante'),],
            'nombres'       => 'required|string|max:30',
            'apellidos'    => 'required|string|max:30',
            'tipo'    => 'required',
            'celular'    => 'required|max:10',
            'correo'    => [
                'required','email',Rule::unique('users','email')->ignore($user->email,'email'),],
            'fechanacimiento'    => 'required',
            'genero'    => 'required'
        );
        $this->validate(request(), $rules);

        // store
        Estudiante::updateOrCreate(['idestudiante'  => $id], [
            'idcarrera'       => request('carrera'),
            'cedulaestudiante'       => request('cedula'),
            'nombresestudiante'      => request('nombres'),
            'apellidosestudiante'      => request('apellidos'),
            'tipoestudiante'      => request('tipo'),
            'correoestudiante'      => request('correo'),
            'celularestudiante'      => request('celular'),
            'fechanacimientoestudiante'      => request('fechanacimiento'),
            'generoestudiante'      => request('genero')
        ]);


        Flash::success('Actualizado Correctamente');
        return redirect('estudiantes');
    }


    public function destroy($estudiante)
    {
        Estudiante::find($estudiante)
            ->delete();

        return redirect('estudiantes');
    }
}
