<?php

namespace App\Http\Controllers;

use App\Organizacion;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArchivosController extends Controller{

    public function __construct(){
        $this->middleware('auth')->except(['mostrarAvatar','mostrarLogo']);
    }

    public function subir(Request $datos){
        $id     =   Auth::user()->id;
        $path   =   storage_path("app/usuarios/$id/");
        $files  =   $datos->file('file');
        $i=0;
        foreach($files as $file){
            $i++;
            $ext = $file->getClientOriginalExtension();
            $nom = $file->getClientOriginalName();
            $file->move($path,$nom);

        }
        return (['val'=>true]);
    }

    public function listar(){
        $id     =   Auth::user()->id;
        $lista  =   Storage::disk('usuarios')->allFiles($id);
        $aux    =   [];
        foreach ($lista as $item){
            $a['ext']   =   strtolower(pathinfo($item, PATHINFO_EXTENSION));
            $a['name']  =   str_replace(["$id/",".".$a['ext']], "",$item);
            $a['file']  =   $item;
            $aux[]=$a;
        }
        return $aux;
    }

    public function descargar(Request $datos){
        return Storage::disk('usuarios')->download($datos->nombre);
    }

    public function mostrar(Request $datos){
        if(Storage::disk('usuarios')->exists($datos->nombre)){
            $archivo    =   Storage::disk('usuarios')->get($datos->nombre);
            $img        =   Image::make($archivo);
            return ($img)->response();
        }else{
            return $this->mostrarComentario($datos);
        }
    }

    public function eliminar(Request $datos){
        Storage::disk('usuarios')->delete($datos->nombre);
        return (['val'=>true]);
    }

    public function guardarEnProyecto($proyecto){
        $proyecto   =   sha1(md5($proyecto));
        if($this->proyectoArchivos()){
            $id     =   Auth::user()->id;
            $files = Storage::disk('usuarios')->allFiles($id);
            Storage::disk('proyectos')->makeDirectory($proyecto);
            foreach ($files as $file) {
                $full_path_source = str_replace("/app/","/app/usuarios/",Storage::getDriver()->getAdapter()->applyPathPrefix($file));
                $full_path_dest = Storage::disk('proyectos')->getDriver()->getAdapter()->applyPathPrefix($proyecto . '/' . basename($file));
                File::move($full_path_source, $full_path_dest);
            }
            return (['val'=>true]);
        }
    }

    public function guardarEnComentario($comentario){
        $id     =   Auth::user()->id;
        $files = Storage::disk('usuarios')->allFiles($id);
        Storage::disk('comentarios')->makeDirectory($comentario);
        foreach ($files as $file) {
            $full_path_source = str_replace("/app/","/app/usuarios/",Storage::getDriver()->getAdapter()->applyPathPrefix($file));
            $full_path_dest = Storage::disk('comentarios')->getDriver()->getAdapter()->applyPathPrefix($comentario . '/' . basename($file));
            File::move($full_path_source, $full_path_dest);
        }
        return (['val'=>true]);
    }

    public function listarComentario($id){
        $lista  =   Storage::disk('comentarios')->allFiles($id);
        $aux    =   null;
        foreach ($lista as $item){
            $a['down']  =   route('imagenes',['nombre'=>$item]);
            $a['ext']   =   strtolower(pathinfo($item, PATHINFO_EXTENSION));
            $a['name']  =   str_replace(["$id/",".".$a['ext']], "",$item);
            $a['file']  =   $item;
            $aux[]=$a;
        }
        return $aux;
    }

    public function mostrarComentario(Request $datos){
        if(Storage::disk('comentarios')->exists($datos->nombre)){
            $archivo    =   Storage::disk('comentarios')->get($datos->nombre);
            $img        =   Image::make($archivo);
            return ($img)->response();
        }
    }


    public function proyectoArchivos(){
        if(count($this->listar())>0)
            return true;
        else
            return false;
    }

    public function listarProyecto($id){
        $lista  =   Storage::disk('proyectos')->allFiles($id);
        $aux    =   null;
        foreach ($lista as $item){
            $a['down']  =   route('app.proyecto.download',['nombre'=>$item]);
            $a['ext']   =   strtolower(pathinfo($item, PATHINFO_EXTENSION));
            $a['name']  =   str_replace(["$id/",".".$a['ext']], "",$item);
            $a['file']  =   $item;
            $aux[]=$a;
        }
        return $aux;
    }

    public function descargarProyecto(Request $datos){
        try {
            return Storage::disk('proyectos')->download($datos->nombre);
        } catch (\Exception $e) {
            $string = substr($datos->nombre,41,1000);
            $string = str_replace(".".pathinfo($string, PATHINFO_EXTENSION), "",$string);
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
            $string = preg_replace('/-+/', '-', $string);
            return Storage::disk('proyectos')->download($datos->nombre,$string);
        }
    }

    public function subirAvatar(Request $datos){
        //return $datos;
        $id     =   hash_hmac('ripemd160',Auth::user()->id, config('app.key'));
        $path   =   storage_path("app/usuarios/");
        $file   =   $datos->file('avatar');
        $img    =   Image::make($file)->fit(300);
        $img->save($path.$id.".png");

        $usuario            =   Auth::user();
        $usuario->avatar    =   route('usuario.img',$id.'?p='.date("His"));
        $usuario->save();
        unset($img);
        return (['val'=>true,'mensaje'=>'Se ha actualizado su imagen de perfil']);
    }

    public function subirLogo(Request $datos){
        //return $datos;
        $id     =   hash_hmac('ripemd160',Auth::user()->id_or, config('app.key'));
        $path   =   storage_path("app/organizaciones/");
        $file   =   $datos->file('logo');
        $img    =   Image::make($file)->fit(300);
        $img->save($path.$id.".png");

        $org            =   Organizacion::find(Auth::user()->id_or);
        $org->logo_or   =   route('organizacion.img',$id.'?p='.date("His"));
        $org->save();
        unset($img);
        return (['val'=>true,'mensaje'=>'Se ha actualizado el Logo de su Organización']);
    }

    public function mostrarAvatar($token){
        if(Storage::disk('usuarios')->exists("$token.png")){
            $archivo    =   Storage::disk('usuarios')->get("$token.png");
            $img        =   Image::make($archivo);
            return ($img)->response();
        }
    }

    public function mostrarLogo($token){
        if(Storage::disk('organizaciones')->exists("$token.png")){
            $archivo    =   Storage::disk('organizaciones')->get("$token.png");
            $img        =   Image::make($archivo);
            return ($img)->response();
        }
    }
}
