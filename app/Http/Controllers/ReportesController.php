<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Carrera;
use App\Escuela;
use App\Estudiante;
use App\Facultad;
use App\Nivel;
use App\PeriodoAcademico;
use App\Practica;
use App\Profesor;
use App\Sede;
use function Faker\Provider\pt_BR\check_digit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use PhpParser\Node\Scalar\String_;

class ReportesController extends Controller
{
    public function index()
    {
        $periodos = PeriodoAcademico::all();
        $niveles = Nivel::all();
        $estudiantes = Estudiante::all();
        $profesores = Profesor::all();
        //var_dump($estudiantes); exit();
        return view('reportes.index', compact('estudiantes', 'niveles', 'periodos', 'profesores'));
    }
    public function reporte1(Request $request)
    {
        $periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->groupBy('estudiante.idestudiante')
            /*->whereDate('fechafinpractica','>=',$periodo->fechainicioperiodoacademico)
            ->whereDate('fechafinpractica','<=',$periodo->fechafinperiodoacademico)*/
            ->havingRaw('SUM(practica.horaspractica) >= 120')
            ->havingRaw("max(practica.fechafinpractica) >= '".$periodo->fechainicioperiodoacademico."'")
            ->havingRaw("max(practica.fechafinpractica) <= '".$periodo->fechafinperiodoacademico."'")
            ->get();

        return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function descargaexcelr1(PeriodoAcademico $periodo)
    {

        Excel::create('Reporte-finalizacionen-Periodo'.$periodo->nombreperiodoacademico, function ($excel) use($periodo){
           $excel->sheet('Reporte', function ($sheet) use ($periodo){
               $sheet->mergeCells('A1:I1');
               $sheet->mergeCells('A2:I2');
               $sheet->cells('A1:I1', function($cells) {
                   $cells->setFontWeight('bold');
                   $cells->setFontSize(16);
               });
               $sheet->cells('A2:K2', function($cells) {
                   $cells->setFontWeight('bold');
                   $cells->setFontSize(18);
               });
               $sheet->cells('A4:W4', function($cells) {

                   $cells->setBackground('#B1A0C7');
                   $cells->setFontWeight('bold');

               });
               $sheet->setFontFamily('Calibri');
               $sheet->setFontSize(9);
                $titulo = 'REPORTE DE PRÁCTICAS PREPROFESIONALES '.$periodo->nombreperiodoacademico;
                //var_dump($periodo->fechainicioperiodoacademico); exit();
               $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                   ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                   ->groupBy('estudiante.idestudiante')
                   /*->whereDate('fechafinpractica','>=',$periodo->fechainicioperiodoacademico)
                   ->whereDate('fechafinpractica','<=',$periodo->fechafinperiodoacademico)*/
                   ->havingRaw('SUM(practica.horaspractica) >= 120')
                   ->havingRaw("max(practica.fechafinpractica) >= '".$periodo->fechainicioperiodoacademico."'")
                   ->havingRaw("max(practica.fechafinpractica) <= '".$periodo->fechafinperiodoacademico."'")
                   ->get();
               $sheet->appendRow(1, array(
                   'PONTIFICIA UNIVERSIDAD CATÓLICA DEL ECUADOR'
               ));
               $sheet->appendRow(2, array(
                   $titulo
               ));
               $cabecera = [];
               $cabecera[0]= 'No.';
               $cabecera[1]= 'Unidad Académica';
               $cabecera[2]= 'Carrera';
               $cabecera[3]= 'Identificación';
               $cabecera[4]= 'Apellidos y Nombres del Estudiante';
               $cabecera[5]= 'Fecha de Inicio Práctica 1';
               $cabecera[6]= 'Fecha de Finalizacion Práctica 1';
               $cabecera[7]= 'No. de Horas Práctica 1';
               $cabecera[8]= 'Centro de Prácticas 1';
               $cabecera[9]= 'Tipo de Intitución 1';
               $cabecera[10]= 'Sector Institución 1';
               $cabecera[11]= 'Fecha de Inicio Práctica 2';
               $cabecera[12]= 'Fecha de Finalizacion Práctica 2';
               $cabecera[13]= 'No. de Horas Práctica 2';
               $cabecera[14]= 'Centro de Prácticas 2';
               $cabecera[15]= 'Tipo de Intitución 2';
               $cabecera[16]= 'Sector Institución 2';
               $cabecera[17]= 'Fecha de Inicio Práctica 3';
               $cabecera[18]= 'Fecha de Finalizacion Práctica 3';
               $cabecera[19]= 'No. de Horas Práctica 3';
               $cabecera[20]= 'Centro de Prácticas 3';
               $cabecera[21]= 'Tipo de Intitución 3';
               $cabecera[22]= 'Sector Institución 3';

               $sheet->appendRow(4, $cabecera);
               $numero = 1;
               foreach ($estudiantes as $estudiante){


                   $practicas = Practica::where('idestudiante', '=', $estudiante->idestudiante)->get();
                   $row = [];
                   $row[0] = $numero++;
                   $row[1] = $estudiante->carrera->escuela->facultad->nombrefacultad;
                   $row[2] = $estudiante->carrera->nombrecarrera;
                   $row[3] = $estudiante->cedulaestudiante;
                   $row[4] = $estudiante->apellidosestudiante.' '.$estudiante->nombresestudiante;
                   $columna =5;
                   foreach ($practicas as $practica){
                       $row[$columna++] = $practica->fechainiciopractica;
                       $row[$columna++] = $practica->fechafinpractica;
                       $row[$columna++] = $practica->horaspractica;
                       $row[$columna++] = $practica->tutore->empresa->nombreempresa;
                       $row[$columna++] = $practica->tutore->empresa->tipoempresa;
                       $row[$columna++] = $practica->tutore->empresa->sectorempresa;
                   }
                   $sheet->appendRow($row);
               }

               $sheet->setBorder('A4:W'.($numero+3), 'thin');
           });
        })->export('xlsx');

        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function reporte2(Request $request)
    {
        $periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->groupBy('estudiante.idestudiante')
            ->where('practica.idperiodoacademico','>=',$periodo->idperiodoacademico)
            ->get();

        return view('reportes.reporte2', compact('estudiantes', 'periodo'));
    }
    public function descargaexcelr2(PeriodoAcademico $periodo)
    {

        Excel::create('ReportePeriodo'.$periodo->nombreperiodoacademico, function ($excel) use($periodo){
            $excel->sheet('Reporte', function ($sheet) use ($periodo){
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->cells('A1:I1', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(16);
                });
                $sheet->cells('A2:K2', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(18);
                });
                $sheet->cells('A4:W4', function($cells) {

                    $cells->setBackground('#B1A0C7');
                    $cells->setFontWeight('bold');

                });
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(9);
                $titulo = 'REPORTE DE PRACTICA PREPROFESIONALES '.$periodo->nombreperiodoacademico;
                //var_dump($periodo->fechainicioperiodoacademico); exit();
                $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                    ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->groupBy('estudiante.idestudiante')
                    ->where('practica.idperiodoacademico','=',$periodo->idperiodoacademico)
                    ->get();
                $sheet->appendRow(1, array(
                    'PONTIFICIA UNIVERSIDAD CATOLICA DEL ECUADOR'
                ));
                $sheet->appendRow(2, array(
                    $titulo
                ));
                $cabecera = [];
                $cabecera[0]= 'No.';
                $cabecera[1]= 'Unidad Academica';
                $cabecera[2]= 'Carrera';
                $cabecera[3]= 'Identificacion';
                $cabecera[4]= 'Apellidos y Nombres del Estudiante';
                $cabecera[5]= 'Fecha de Inicio Practica 1';
                $cabecera[6]= 'Fecha de Finalizacion Practica 1';
                $cabecera[7]= 'No. de Horas Practica 1';
                $cabecera[8]= 'Centro de Practicas 1';
                $cabecera[9]= 'Tipo de Intitucion 1';
                $cabecera[10]= 'Sector Institucion 1';
                $cabecera[11]= 'Fecha de Inicio Practica 2';
                $cabecera[12]= 'Fecha de Finalizacion Practica 2';
                $cabecera[13]= 'No. de Horas Practica 2';
                $cabecera[14]= 'Centro de Practicas 2';
                $cabecera[15]= 'Tipo de Intitucion 2';
                $cabecera[16]= 'Sector Institucion 2';
                $cabecera[17]= 'Fecha de Inicio Practica 3';
                $cabecera[18]= 'Fecha de Finalizacion Practica 3';
                $cabecera[19]= 'No. de Horas Practica 3';
                $cabecera[20]= 'Centro de Practicas 3';
                $cabecera[21]= 'Tipo de Intitucion 3';
                $cabecera[22]= 'Sector Institucion 3';

                $sheet->appendRow(4, $cabecera);
                $numero = 1;
                foreach ($estudiantes as $estudiante){


                    $practicas = Practica::where('idestudiante', '=', $estudiante->idestudiante)
                        ->where('practica.idperiodoacademico', '=', $periodo->idperiodoacademico)->get();
                    $row = [];
                    $row[0] = $numero++;
                    $row[1] = $estudiante->carrera->escuela->facultad->nombrefacultad;
                    $row[2] = $estudiante->carrera->nombrecarrera;
                    $row[3] = $estudiante->cedulaestudiante;
                    $row[4] = $estudiante->apellidosestudiante.' '.$estudiante->nombresestudiante;
                    $columna =5;
                    foreach ($practicas as $practica){
                        $row[$columna++] = $practica->fechainiciopractica;
                        $row[$columna++] = $practica->fechafinpractica;
                        $row[$columna++] = $practica->horaspractica;
                        $row[$columna++] = $practica->tutore->empresa->nombreempresa;
                        $row[$columna++] = $practica->tutore->empresa->tipoempresa;
                        $row[$columna++] = $practica->tutore->empresa->sectorempresa;
                    }
                    $sheet->appendRow($row);
                }

                $sheet->setBorder('A4:W'.($numero+3), 'thin');
            });
        })->export('xlsx');

        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function reporte3(Request $request)
    {
        //$periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();
        $tipopractica = request('tipopractica');

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->groupBy('estudiante.idestudiante')
            ->where('practica.tipopractica', '=', $tipopractica)
            ->get();
        //var_dump($tipopractica); exit();

        return view('reportes.reporte3', compact('estudiantes', 'tipopractica'));
    }
    public function descargaexcelr3($tipopractica)
    {

        Excel::create('Reporte'.$tipopractica, function ($excel) use($tipopractica){
            $excel->sheet('Reporte', function ($sheet) use ($tipopractica){
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->cells('A1:I1', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(16);
                });
                $sheet->cells('A2:K2', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(18);
                });
                $sheet->cells('A4:W4', function($cells) {

                    $cells->setBackground('#B1A0C7');
                    $cells->setFontWeight('bold');

                });
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(9);
                $titulo = 'REPORTE DE PRACTICAS TIPO '.$tipopractica;
                //var_dump($periodo->fechainicioperiodoacademico); exit();

                $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                    ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->groupBy('estudiante.idestudiante')
                    ->where('practica.tipopractica', '=', $tipopractica)
                    ->get();
                $sheet->appendRow(1, array(
                    'PONTIFICIA UNIVERSIDAD CATOLICA DEL ECUADOR'
                ));
                $sheet->appendRow(2, array(
                    $titulo
                ));
                $cabecera = [];
                $cabecera[0]= 'No.';
                $cabecera[1]= 'Unidad Academica';
                $cabecera[2]= 'Carrera';
                $cabecera[3]= 'Identificacion';
                $cabecera[4]= 'Apellidos y Nombres del Estudiante';
                $cabecera[5]= 'Fecha de Inicio Practica 1';
                $cabecera[6]= 'Fecha de Finalizacion Practica 1';
                $cabecera[7]= 'No. de Horas Practica 1';
                $cabecera[8]= 'Centro de Practicas 1';
                $cabecera[9]= 'Tipo de Intitucion 1';
                $cabecera[10]= 'Sector Institucion 1';
                $cabecera[11]= 'Fecha de Inicio Practica 2';
                $cabecera[12]= 'Fecha de Finalizacion Practica 2';
                $cabecera[13]= 'No. de Horas Practica 2';
                $cabecera[14]= 'Centro de Practicas 2';
                $cabecera[15]= 'Tipo de Intitucion 2';
                $cabecera[16]= 'Sector Institucion 2';
                $cabecera[17]= 'Fecha de Inicio Practica 3';
                $cabecera[18]= 'Fecha de Finalizacion Practica 3';
                $cabecera[19]= 'No. de Horas Practica 3';
                $cabecera[20]= 'Centro de Practicas 3';
                $cabecera[21]= 'Tipo de Intitucion 3';
                $cabecera[22]= 'Sector Institucion 3';

                $sheet->appendRow(4, $cabecera);
                $numero = 1;
                foreach ($estudiantes as $estudiante){


                    $practicas = Practica::where('idestudiante', '=', $estudiante->idestudiante)
                        ->where('practica.tipopractica', '=', $tipopractica)->get();
                    $row = [];
                    $row[0] = $numero++;
                    $row[1] = $estudiante->carrera->escuela->facultad->nombrefacultad;
                    $row[2] = $estudiante->carrera->nombrecarrera;
                    $row[3] = $estudiante->cedulaestudiante;
                    $row[4] = $estudiante->apellidosestudiante.' '.$estudiante->nombresestudiante;
                    $columna =5;
                    foreach ($practicas as $practica){
                        $row[$columna++] = $practica->fechainiciopractica;
                        $row[$columna++] = $practica->fechafinpractica;
                        $row[$columna++] = $practica->horaspractica;
                        $row[$columna++] = $practica->tutore->empresa->nombreempresa;
                        $row[$columna++] = $practica->tutore->empresa->tipoempresa;
                        $row[$columna++] = $practica->tutore->empresa->sectorempresa;
                    }
                    $sheet->appendRow($row);
                }

                $sheet->setBorder('A4:W'.($numero+3), 'thin');
            });
        })->export('xlsx');

        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function reporte4(Request $request)
    {
        //$periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();
        $tipoempresa = request('tipoempresa');

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->leftJoin('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->leftJoin('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->groupBy('estudiante.idestudiante')
            ->where('empresa.tipoempresa', '=', $tipoempresa)
            ->get();
        //var_dump($tipopractica); exit();

        return view('reportes.reporte4', compact('estudiantes', 'tipoempresa'));
    }
    public function descargaexcelr4($tipoempresa)
    {

        Excel::create('Reporte'.$tipoempresa, function ($excel) use($tipoempresa){
            $excel->sheet('Reporte', function ($sheet) use ($tipoempresa){
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->cells('A1:I1', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(16);
                });
                $sheet->cells('A2:K2', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(18);
                });
                $sheet->cells('A4:W4', function($cells) {

                    $cells->setBackground('#B1A0C7');
                    $cells->setFontWeight('bold');

                });
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(9);
                $titulo = 'REPORTE DE PRACTICAS DE INTITUCINES TIPO '.$tipoempresa;
                //var_dump($periodo->fechainicioperiodoacademico); exit();

                $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                    ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->leftJoin('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                    ->leftJoin('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                    ->groupBy('estudiante.idestudiante')
                    ->where('empresa.tipoempresa', '=', $tipoempresa)
                    ->get();
                $sheet->appendRow(1, array(
                    'PONTIFICIA UNIVERSIDAD CATOLICA DEL ECUADOR'
                ));
                $sheet->appendRow(2, array(
                    $titulo
                ));
                $cabecera = [];
                $cabecera[0]= 'No.';
                $cabecera[1]= 'Unidad Academica';
                $cabecera[2]= 'Carrera';
                $cabecera[3]= 'Identificacion';
                $cabecera[4]= 'Apellidos y Nombres del Estudiante';
                $cabecera[5]= 'Fecha de Inicio Practica 1';
                $cabecera[6]= 'Fecha de Finalizacion Practica 1';
                $cabecera[7]= 'No. de Horas Practica 1';
                $cabecera[8]= 'Centro de Practicas 1';
                $cabecera[9]= 'Tipo de Intitucion 1';
                $cabecera[10]= 'Sector Institucion 1';
                $cabecera[11]= 'Fecha de Inicio Practica 2';
                $cabecera[12]= 'Fecha de Finalizacion Practica 2';
                $cabecera[13]= 'No. de Horas Practica 2';
                $cabecera[14]= 'Centro de Practicas 2';
                $cabecera[15]= 'Tipo de Intitucion 2';
                $cabecera[16]= 'Sector Institucion 2';
                $cabecera[17]= 'Fecha de Inicio Practica 3';
                $cabecera[18]= 'Fecha de Finalizacion Practica 3';
                $cabecera[19]= 'No. de Horas Practica 3';
                $cabecera[20]= 'Centro de Practicas 3';
                $cabecera[21]= 'Tipo de Intitucion 3';
                $cabecera[22]= 'Sector Institucion 3';


                $sheet->appendRow(4, $cabecera);
                $numero = 1;
                foreach ($estudiantes as $estudiante){


                    $practicas = Practica::
                        join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                        ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                        ->where('idestudiante', '=', $estudiante->idestudiante)
                        ->where('empresa.tipoempresa', '=', $tipoempresa)->get();
                    $row = [];
                    $row[0] = $numero++;
                    $row[1] = $estudiante->carrera->escuela->facultad->nombrefacultad;
                    $row[2] = $estudiante->carrera->nombrecarrera;
                    $row[3] = $estudiante->cedulaestudiante;
                    $row[4] = $estudiante->apellidosestudiante.' '.$estudiante->nombresestudiante;
                    $columna =5;
                    foreach ($practicas as $practica){
                        $row[$columna++] = $practica->fechainiciopractica;
                        $row[$columna++] = $practica->fechafinpractica;
                        $row[$columna++] = $practica->horaspractica;
                        $row[$columna++] = $practica->tutore->empresa->nombreempresa;
                        $row[$columna++] = $practica->tutore->empresa->tipoempresa;
                        $row[$columna++] = $practica->tutore->empresa->sectorempresa;
                    }
                    $sheet->appendRow($row);
                }

                $sheet->setBorder('A4:W'.($numero+3), 'thin');
            });
        })->export('xlsx');

        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function reporte5(Request $request)
    {
        //$periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();
        $sector = request('sector');

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->leftJoin('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->leftJoin('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->groupBy('estudiante.idestudiante')
            ->where('empresa.sectorempresa', '=', $sector)
            ->get();
        //var_dump($tipopractica); exit();

        return view('reportes.reporte5', compact('estudiantes', 'sector'));
    }
    public function descargaexcelr5($sector)
    {

        Excel::create('ReportePPEmpresa'.$sector, function ($excel) use($sector){
            $excel->sheet('Reporte', function ($sheet) use ($sector){
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->cells('A1:I1', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(16);
                });
                $sheet->cells('A2:K2', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(18);
                });
                $sheet->cells('A4:W4', function($cells) {

                    $cells->setBackground('#B1A0C7');
                    $cells->setFontWeight('bold');

                });
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(9);
                $titulo = 'REPORTE DE PRACTICAS DE INTITUCINES DEL SECTOR '.$sector;
                //var_dump($periodo->fechainicioperiodoacademico); exit();

                $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                    ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->leftJoin('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                    ->leftJoin('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                    ->groupBy('estudiante.idestudiante')
                    ->where('empresa.sectorempresa', '=', $sector)
                    ->get();
                $sheet->appendRow(1, array(
                    'PONTIFICIA UNIVERSIDAD CATOLICA DEL ECUADOR'
                ));
                $sheet->appendRow(2, array(
                    $titulo
                ));
                $cabecera = [];
                $cabecera[0]= 'No.';
                $cabecera[1]= 'Unidad Academica';
                $cabecera[2]= 'Carrera';
                $cabecera[3]= 'Identificacion';
                $cabecera[4]= 'Apellidos y Nombres del Estudiante';
                $cabecera[5]= 'Fecha de Inicio Practica 1';
                $cabecera[6]= 'Fecha de Finalizacion Practica 1';
                $cabecera[7]= 'No. de Horas Practica 1';
                $cabecera[8]= 'Centro de Practicas 1';
                $cabecera[9]= 'Tipo de Intitucion 1';
                $cabecera[10]= 'Sector Institucion 1';
                $cabecera[11]= 'Fecha de Inicio Practica 2';
                $cabecera[12]= 'Fecha de Finalizacion Practica 2';
                $cabecera[13]= 'No. de Horas Practica 2';
                $cabecera[14]= 'Centro de Practicas 2';
                $cabecera[15]= 'Tipo de Intitucion 2';
                $cabecera[16]= 'Sector Institucion 2';
                $cabecera[17]= 'Fecha de Inicio Practica 3';
                $cabecera[18]= 'Fecha de Finalizacion Practica 3';
                $cabecera[19]= 'No. de Horas Practica 3';
                $cabecera[20]= 'Centro de Practicas 3';
                $cabecera[21]= 'Tipo de Intitucion 3';
                $cabecera[22]= 'Sector Institucion 3';

                $sheet->appendRow(4, $cabecera);
                $numero = 1;
                foreach ($estudiantes as $estudiante){


                    $practicas = Practica::
                        leftJoin('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                        ->leftJoin('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                        ->where('empresa.sectorempresa', '=', $sector)
                        ->where('idestudiante', '=', $estudiante->idestudiante)->get();
                    $row = [];
                    $row[0] = $numero++;
                    $row[1] = $estudiante->carrera->escuela->facultad->nombrefacultad;
                    $row[2] = $estudiante->carrera->nombrecarrera;
                    $row[3] = $estudiante->cedulaestudiante;
                    $row[4] = $estudiante->apellidosestudiante.' '.$estudiante->nombresestudiante;
                    $columna =5;
                    foreach ($practicas as $practica){
                        $row[$columna++] = $practica->fechainiciopractica;
                        $row[$columna++] = $practica->fechafinpractica;
                        $row[$columna++] = $practica->horaspractica;
                        $row[$columna++] = $practica->tutore->empresa->nombreempresa;
                        $row[$columna++] = $practica->tutore->empresa->tipoempresa;
                        $row[$columna++] = $practica->tutore->empresa->sectorempresa;
                    }
                    $sheet->appendRow($row);
                }

                $sheet->setBorder('A4:W'.($numero+3), 'thin');
            });
        })->export('xlsx');

        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function reporte6(Request $request)
    {
        $nivel = Nivel::where('idnivel', '=', request('nivel'))->first();
        //$nivel = request('nivel');

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->groupBy('estudiante.idestudiante')
            ->where('practica.idnivel','=',$nivel->idnivel)
            ->get();
        //var_dump($tipopractica); exit();

        return view('reportes.reporte6', compact('estudiantes', 'nivel'));
    }
    public function reporte2p(Request $request)
    {
        $periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();
        $practicas = Practica::where('practica.idperiodoacademico','=',$periodo->idperiodoacademico)
            ->orderBy('practica.idpractica', 'desc')->get();
        return view('reportes.reporte2p', compact('practicas', 'periodo'));
    }
    public function reporte3p(Request $request)
    {
        $tipopractica = request('tipopractica');
        $practicas = Practica::where('practica.tipopractica','=',$tipopractica)
            ->orderBy('practica.idpractica', 'desc')->get();
        return view('reportes.reporte3p', compact('practicas', 'tipopractica'));
    }
    public function reporte4p(Request $request)
    {
        $tipoempresa = request('tipoempresa');
        $practicas = Practica::
            join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.tipoempresa','=',$tipoempresa)
            ->orderBy('practica.idpractica', 'desc')->get();
        return view('reportes.reporte4p', compact('practicas', 'tipoempresa'));
    }
    public function reporte5p(Request $request)
    {
        $sectorempresa = request('sector');
        $practicas = Practica::
            join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.sectorempresa','=',$sectorempresa)
            ->orderBy('practica.idpractica', 'desc')->get();
        return view('reportes.reporte5p', compact('practicas', 'sectorempresa'));
    }
    public function reporte6p(Request $request)
    {
        $nivel = Nivel::where('idnivel', '=', request('nivel'))->first();
        $practicas = Practica::where('practica.idnivel','=',$nivel->idnivel)
            ->orderBy('practica.idpractica', 'desc')->get();
        return view('reportes.reporte6p', compact('practicas', 'nivel'));
    }
    public function descargaexcelr6(Nivel $nivel)
    {

        Excel::create('ReporteNivel'.$nivel->nombrenivel, function ($excel) use($nivel){
            $excel->sheet('Reporte', function ($sheet) use ($nivel){
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->cells('A1:I1', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(16);
                });
                $sheet->cells('A2:K2', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(18);
                });
                $sheet->cells('A4:W4', function($cells) {

                    $cells->setBackground('#B1A0C7');
                    $cells->setFontWeight('bold');

                });
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(9);
                $titulo = 'REPORTE DE PRACTICAS DE ESTUDIANTES EN NIVEL '.$nivel->nombrenivel;
                //var_dump($periodo->fechainicioperiodoacademico); exit();

                $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                    ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->groupBy('estudiante.idestudiante')
                    ->where('practica.idnivel', '=', $nivel->idnivel)
                    ->get();
                $sheet->appendRow(1, array(
                    'PONTIFICIA UNIVERSIDAD CATOLICA DEL ECUADOR'
                ));
                $sheet->appendRow(2, array(
                    $titulo
                ));
                $cabecera = [];
                $cabecera[0]= 'No.';
                $cabecera[1]= 'Unidad Academica';
                $cabecera[2]= 'Carrera';
                $cabecera[3]= 'Identificacion';
                $cabecera[4]= 'Apellidos y Nombres del Estudiante';
                $cabecera[5]= 'Fecha de Inicio Practica 1';
                $cabecera[6]= 'Fecha de Finalizacion Practica 1';
                $cabecera[7]= 'No. de Horas Practica 1';
                $cabecera[8]= 'Centro de Practicas 1';
                $cabecera[9]= 'Tipo de Intitucion 1';
                $cabecera[10]= 'Sector Institucion 1';
                $cabecera[11]= 'Fecha de Inicio Practica 2';
                $cabecera[12]= 'Fecha de Finalizacion Practica 2';
                $cabecera[13]= 'No. de Horas Practica 2';
                $cabecera[14]= 'Centro de Practicas 2';
                $cabecera[15]= 'Tipo de Intitucion 2';
                $cabecera[16]= 'Sector Institucion 2';
                $cabecera[17]= 'Fecha de Inicio Practica 3';
                $cabecera[18]= 'Fecha de Finalizacion Practica 3';
                $cabecera[19]= 'No. de Horas Practica 3';
                $cabecera[20]= 'Centro de Practicas 3';
                $cabecera[21]= 'Tipo de Intitucion 3';
                $cabecera[22]= 'Sector Institucion 3';

                $sheet->appendRow(4, $cabecera);
                $numero = 1;
                foreach ($estudiantes as $estudiante){


                    $practicas = Practica::where('idestudiante', '=', $estudiante->idestudiante)
                        ->where('practica.idnivel', '=', $nivel->idnivel)->get();
                    $row = [];
                    $row[0] = $numero++;
                    $row[1] = $estudiante->carrera->escuela->facultad->nombrefacultad;
                    $row[2] = $estudiante->carrera->nombrecarrera;
                    $row[3] = $estudiante->cedulaestudiante;
                    $row[4] = $estudiante->apellidosestudiante.' '.$estudiante->nombresestudiante;
                    $columna =5;
                    foreach ($practicas as $practica){
                        $row[$columna++] = $practica->fechainiciopractica;
                        $row[$columna++] = $practica->fechafinpractica;
                        $row[$columna++] = $practica->horaspractica;
                        $row[$columna++] = $practica->tutore->empresa->nombreempresa;
                        $row[$columna++] = $practica->tutore->empresa->tipoempresa;
                        $row[$columna++] = $practica->tutore->empresa->sectorempresa;
                    }
                    $sheet->appendRow($row);
                }

                $sheet->setBorder('A4:W'.($numero+3), 'thin');
            });
        })->export('xlsx');

        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function descargaexcelr7(Estudiante $estudiante, Request $request)
    {
        //var_dump($request->perfiles);exit();

        $export = Excel::create('Registro Base de datos '.$estudiante->apellidosestudiante, function ($excel) use($estudiante, $request){
            $excel->sheet('Reporte', function ($sheet) use ($estudiante, $request){
                $sheet->mergeCells('A6:G6');
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(12);
                $titulo = 'REGISTRO PRACTICAS PRE PROFESIONALES USUARIO';
                //var_dump($periodo->fechainicioperiodoacademico); exit();

                $practicas =Practica::
                    join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
                    ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                    ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                    ->where('practica.idestudiante', '=', $estudiante->idestudiante )->get();

                $sheet->cells('A6', function($cells) use ($titulo) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(14);
                    $cells->setValue($titulo);
                });
                $sheet->setBorder('A8:G9', 'thin');
                $nombres = explode(" ", $estudiante->nombresestudiante);
                $apellidos = explode(" ", $estudiante->apellidosestudiante);
                $sheet->appendRow(8, ['PRIMER APELLIDO', 'SEGUNDO APELLIDO', 'PRIMER NOMBRE', 'SEGUNDO NOMBRE', 'CEDULA', 'USUARIO PUCE']);
                $sheet->appendRow(9, [$apellidos[0], $apellidos[1], $nombres[0], $nombres[1], $estudiante->cedulaestudiante, $estudiante->idestudiante]);
                $numero = 1;
                $fila =11;
                $perfiles = $request->perfiles;
                $total = 0;
                if (count($perfiles) < count($practicas)){
                    for ($i = count($perfiles) ; $i < count($practicas) ; $i++){
                        $perfiles[$i] = '';
                    }
                }
                foreach ($practicas as $practica){
                    $sheet->mergeCells('A'.$fila.':G'.$fila);
                    $sheet->setBorder('A'.$fila.':G'.($fila+2), 'thin');
                    $sheet->cells('A'.$fila, function($cells) use($numero){
                        $cells->setFontWeight('bold');
                        $cells->setFontSize(14);
                        $cells->setValue('PRACTICA No. '.$numero);
                    });
                    $fila++;
                    $sheet->appendRow($fila, ['PRACTICA', 'TIPO', 'PERFIL', 'EMPRESA', 'DESDE', 'HASTA', 'HORAS']); $fila++;
                    $row = [];
                    $row[0] = $numero;
                    $row[1] = $practica->tipopractica;
                    $row[2] = $perfiles[$numero-1];
                    $row[3] = $practica->tutore->empresa->nombreempresa;
                    $row[4] = $practica->fechainiciopractica;
                    $row[5] = $practica->fechafinpractica;
                    $row[6] = $practica->horaspractica;
                    $sheet->appendRow($fila, $row);
                    $fila = $fila+2;
                    $numero++;
                    $total+= (int)$practica->horaspractica;
                }
                $sheet->appendRow($fila, ['','', '', '', '', 'TOTAL: ', $total]);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/encabezadopuce.png'));
                $objDrawing->setCoordinates('A1');
                //$objDrawing->setHeight(90);
                //$objDrawing->setWidth(90);
                $objDrawing->setWorksheet($sheet);
                //$sheet->setBorder('A4:W'.($numero+3), 'thin');

                $sheet->setPageMargin(0.33);
                $sheet->setPrintArea('A1:G'.($fila+2));
                $sheet->setHorizontalCentered(true);
                $sheet->setVerticalCentered(false);
            });
        })->store('xlsx', false, true);
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download($export['full'], 200, $headers );


        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function descargaexcelr8(Estudiante $estudiante, Request $request)
    {
        //var_dump($request->perfiles);exit();

        $export = Excel::create('Registro Base de datos '.$estudiante->apellidosestudiante, function ($excel) use($estudiante, $request){
            $excel->sheet('Reporte', function ($sheet) use ($estudiante, $request){
                $sheet->setWidth(array(
                    'A'     =>  2.49,
                    'B'     =>  3.93,
                    'C'     =>  3.93,
                    'D'     =>  3.93,
                    'E'     =>  4.6,
                    'F'     =>  3.49,
                    'G'     =>  3.27,
                    'H'     =>  39.6,
                    'I'     =>  13.93,
                    'J'     =>  13.93,
                    'K'     =>  13.93,
                    'L'     =>  13.93,
                    'M'     =>  2.38,
                    'N'     =>  1.52,
                    'O'     =>  9.49,
                    'P'     =>  2.93,
                    'Q'     =>  0.25,
                    'R'     =>  18.49,
                    'S'     =>  4.49,
                    'T'     =>  5.82,
                    'U'     =>  4.82,
                    'V'     =>  3.93,
                ));
                $sheet->mergeCells('E1:O1');
                $sheet->mergeCells('E2:O2');
                $sheet->mergeCells('E3:O3');
                $sheet->mergeCells('B6:W6');
                $sheet->mergeCells('D8:H8');
                $sheet->mergeCells('I8:K8');
                $sheet->mergeCells('L8:O8');
                $sheet->mergeCells('P8:R8');
                $sheet->mergeCells('F10:Q14');
                $sheet->mergeCells('A18:F18');
                $sheet->mergeCells('M18:O18');
                $sheet->mergeCells('A19:F19');
                $sheet->mergeCells('M19:O19');
                $sheet->mergeCells('A20:F20');
                $sheet->mergeCells('M20:O20');
                $sheet->mergeCells('A21:F21');
                $sheet->mergeCells('M21:O21');
                $sheet->mergeCells('A22:F22');
                $sheet->mergeCells('M22:O22');
                $sheet->mergeCells('A23:F23');
                $sheet->mergeCells('M23:O23');
                $sheet->mergeCells('A24:F24');
                $sheet->mergeCells('M24:O24');
                $sheet->mergeCells('A25:F25');
                $sheet->mergeCells('M25:O25');
                $sheet->mergeCells('A26:F26');
                $sheet->mergeCells('M26:O26');
                $sheet->mergeCells('C29:G29');
                $sheet->mergeCells('K29:O29');
                $sheet->mergeCells('C30:G30');
                $sheet->mergeCells('K30:O30');
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(12);
                $sheet->cells('E1', function($cells) use ($estudiante) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(14);
                    $cells->setValue('PONTIFICIA UNIVERSIDAD CATOLICA DEL ECUADOR');
                });
                $sheet->cells('E2', function($cells) use ($estudiante) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(12);
                    $cells->setValue('FACULTAD '.$estudiante->carrera->escuela->facultad->nombrefacultad);
                });
                $sheet->cells('E3', function($cells) use ($estudiante) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(12);
                    $cells->setValue('ESCUELA '.$estudiante->carrera->escuela->nombreescuela);
                });
                $sheet->cells('B6', function($cells) use ($estudiante) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(12);
                    $cells->setAlignment('center');
                    $cells->setValue('REGISTRO Y APROBACION DE LA PRACTICA');
                });
                $sheet->cells('D8', function($cells) use ($estudiante) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(12);
                    $cells->setValue('NOMBRE DELE ESTUDIANTE: ');
                });
                $sheet->cells('I8', function($cells) use ($estudiante) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(12);
                    $cells->setAlignment('center');
                    $cells->setValue($estudiante->nombresestudiante.' '.$estudiante->apellidosestudiante);
                });
                $sheet->cells('L8', function($cells) use ($estudiante) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(12);
                    $cells->setAlignment('center');
                    $cells->setValue('CEDULA: ');
                });
                $sheet->cells('P8', function($cells) use ($estudiante) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(12);
                    $cells->setAlignment('center');
                    $cells->setValue($estudiante->cedulaestudiante);
                });
                $sheet->cells('F10', function($cells) use ($estudiante) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(14);
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setValue('LÍNEAS DE PRÁCTICAS PRE PROFESIONALES EN FUNCIÓN DEL PERFIL PROFESIONAL Y LAS AREAS DE FORMACIÓN');
                });
                $sheet->cells('C29', function($cells) use ($estudiante) {
                    $cells->setAlignment('center');
                    $cells->setValue('Fecha de Entrega: ');
                });
                $sheet->cells('H29', function($cells) use ($estudiante) {
                    $cells->setFontWeight('bold');
                    $cells->setBorder('none', 'none', 'thin', 'none');
                    $cells->setAlignment('center');
                    $cells->setValue(date('d/m/Y'));
                });
                $sheet->cells('H30', function($cells) use ($estudiante) {
                    $cells->setAlignment('center');
                    $cells->setValue('(dd/mm/aaaa)');
                });
                $sheet->cells('K30', function($cells) use ($estudiante) {
                    $cells->setBorder('thin', 'none', 'none', 'none');
                    $cells->setAlignment('center');
                    $cells->setValue('Coordinador PPP');
                });

                $sheet->setBorder('D8:R8', 'thin');
                $sheet->setBorder('H18:L26', 'thin');

                $sheet->appendRow(18, ['','', '','','','', '', '',  'PRACTICA 1: ', 'PRACTICA 2: ', 'PRACTICA 3: ', 'PRACTICA 4: ']);
                $sheet->appendRow(19, ['','','','','','','', 'Desarrollo de soluciones informáticas']);
                $sheet->appendRow(20, ['','','','','','','', '   Gestión de Tics']);
                $sheet->appendRow(21, ['','','','','','','', ' Base de datos']);
                $sheet->appendRow(22, ['','','','','','','', '   Redes y Comunicaciones']);
                $sheet->appendRow(23, ['','','','','','','', '  Seguridad de la Información']);
                $sheet->appendRow(24, ['','','','','','','', '   Mantenimiento y soporte técnico']);
                $sheet->appendRow(25, ['','','','','','','', 'Gestión de Proyectos']);
                $sheet->appendRow(26, ['','','','','','','', 'Aplicaciones Matemáticas']);
                $indice = 0;
                $arreglo = $request->checks;
                for ($i = 19 ; $i <= 26 ; $i++){
                    for ($j = 0 ; $j < 4 ; $j++){
                        $marca = '';
                        $letra = 'I';
                        if ($j == 0)
                            $letra = 'I';
                        elseif ($j == 1)
                            $letra = 'J';
                        elseif ($j == 2)
                            $letra = 'K';
                        elseif ($j == 3)
                            $letra = 'L';
                        if ($arreglo[$indice]){
                            $marca = 'X';
                        }

                        $sheet->cells($letra.$i, function($cells) use($marca){
                            $cells->setFontWeight('bold');
                            $cells->setAlignment('center');
                            $cells->setValue($marca);
                        });
                        $indice++;

                    }

                }

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/logo-puce.png'));
                $objDrawing->setCoordinates('B1');
                $objDrawing->setHeight(90);
                $objDrawing->setWidth(90);
                $objDrawing->setWorksheet($sheet);
                //$sheet->setBorder('A4:W'.($numero+3), 'thin');

                $sheet->setOrientation('landscape');
                $sheet->setPageMargin(0.33);
                $sheet->setPrintArea('B1:S33');
                $sheet->setHorizontalCentered(true);
                $sheet->setVerticalCentered(true);
            });
        })->store('xlsx', false, true);
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download($export['full'], 200, $headers );


        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function descargaexcelr9(Profesor $profesor, Request $request)
    {
        //var_dump($request->perfiles);exit();

        $export = Excel::create('Registro Base de datos '.$profesor->apellidosestudiante, function ($excel) use($profesor, $request){
            $excel->sheet('Reporte', function ($sheet) use ($profesor, $request){
                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A3:B3');
                $sheet->mergeCells('C3:H3');
                $sheet->mergeCells('A5:D5');
                $sheet->mergeCells('E5:H5');
                $sheet->mergeCells('B7:D7');
                $sheet->mergeCells('F7:H7');
                $sheet->mergeCells('B8:D8');
                $sheet->mergeCells('F8:H8');
                $sheet->mergeCells('A10:B10');
                $sheet->mergeCells('C10:D10');
                $sheet->mergeCells('E10:F10');
                $sheet->mergeCells('G10:H10');
                $sheet->mergeCells('A12:D12');
                $sheet->mergeCells('E12:H12');
                $sheet->mergeCells('A14:C14');
                $sheet->mergeCells('D14:H14');
                $sheet->mergeCells('A16:C16');
                $sheet->mergeCells('D16:H16');
                $sheet->mergeCells('A18:C18');
                $sheet->mergeCells('D18:H18');
                $sheet->mergeCells('A20:C20');
                $sheet->mergeCells('D20:H20');
                $sheet->mergeCells('A22:C22');
                $sheet->mergeCells('D22:H22');
                $sheet->mergeCells('B24:E24');
                $sheet->mergeCells('F24:H24');
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(12);

                $estudiantes =Estudiante::
                    rightJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->select(DB::raw('distinct(estudiante.idestudiante) , estudiante.*'))
                    ->where('practica.idprofesor', '=', $profesor->idprofesor)->get();
                $actividades =Actividad::
                where('idprofesor', '=', $profesor->idprofesor)->get();
                $sheet->appendRow(1, ['INFORME DE FINALIZACION DE VINCULACION CON LA COLECTIVIDAD']);
                $sheet->appendRow(3, ['Fecha del Informe:', '', date('d/m/Y')]);
                $sheet->appendRow(5, ['Nombres y Apellidos completos:','','', '', $request->nombrescompletos]);
                $sheet->appendRow(7, ['Carrera:',$request->carrera,'', '', 'Cedula:', $request->cedula]);
                $sheet->appendRow(8, ['Email:',$request->correo,'', '', 'Telefono:', $request->celular]);
                $sheet->appendRow(10, ['Fecha de Inicio::', '', $request->inicio,'', 'Fecha de Finalizacion:', '',  $request->fin]);
                $sheet->appendRow(12, ['Nombre del Proyecto, Curso o Evento:','','','', $request->proyecto]);
                $sheet->appendRow(14, ['Actividad Realizada:','','', $request->actividad]);
                $sheet->appendRow(16, ['Tipo de Vinculacion:','','', $request->tipo]);
                $sheet->appendRow(18, ['Organizacion contraparte:','','', $request->organizacion]);
                $sheet->appendRow(20, ['Docente responsable de la Unidad:','','', $request->responsable]);
                $sheet->appendRow(22, ['Docente Tutor del Proyecto:','','', $request->tutor]);
                $sheet->appendRow(24, ['No.','Nombre de los estudiantes tutorados','','','', 'Evaluacion Cualitativa']);
                $sheet->cells('A24', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('B24', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('F24', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $numero = 0;
                $fila =25;
                $arreglo = $request->evaluaciones;
                foreach ($estudiantes as $estudiante){
                    $sheet->mergeCells('B'.$fila.':E'.$fila);
                    $sheet->mergeCells('F'.$fila.':H'.$fila);
                    $sheet->appendRow($fila, [$numero+1,$estudiante->nombresestudiante.' '.$estudiante->apellidosestudiante,'','','', $arreglo[$numero]]);
                    $fila++;
                    $numero++;
                }

                $sheet->setBorder('A24:H'.($fila-1), 'thin');
                $sheet->mergeCells('A'.($fila+1).':H'.($fila+1));
                $sheet->mergeCells('C'.($fila+2).':E'.($fila+2));
                $sheet->mergeCells('G'.($fila+2).':H'.($fila+2));
                $sheet->appendRow($fila+1, ['Detalle de Actividades']);
                $sheet->cells('A'.($fila+1), function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->appendRow($fila+2, ['No.','Fecha','Actividades de Docente','','', 'Horas Cumplidas', 'Observaciones']);
                $sheet->cells('A'.($fila+2), function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('B'.($fila+2), function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('C'.($fila+2), function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('F'.($fila+2), function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('G'.($fila+2), function($cells){
                    $cells->setBackground('#d9d9d9');
                });

                $fila2 = $fila+3;
                $numero = 0;
                $total = 0;
                foreach ($actividades as $actividad){
                    $sheet->mergeCells('C'.$fila2.':E'.$fila2);
                    $sheet->mergeCells('G'.$fila2.':H'.$fila2);
                    $sheet->appendRow($fila2, [$numero+1,$actividad->fechaactividad, $actividad->descripcionactividad,'','', $actividad->horasactividad, $actividad->comentarioactividad]);
                    $fila2++;
                    $numero++;
                    $total+= (int)$actividad->horasactividad;
                }

                $sheet->setBorder('A1:H1', 'thin');
                $sheet->setBorder('A3:H3', 'thin');
                $sheet->setBorder('A5:H5', 'thin');
                $sheet->setBorder('A7:H7', 'thin');
                $sheet->setBorder('A8:H8', 'thin');
                $sheet->setBorder('A10:H10', 'thin');
                $sheet->setBorder('A12:H12', 'thin');
                $sheet->setBorder('A14:H14', 'thin');
                $sheet->setBorder('A16:H16', 'thin');
                $sheet->setBorder('A18:H18', 'thin');
                $sheet->setBorder('A20:H20', 'thin');
                $sheet->setBorder('A22:H22', 'thin');
                $sheet->cells('A1', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A3', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A5', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A7', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A8', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('E7', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('E8', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A10', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('E10', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A12', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A14', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A16', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A18', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A20', function($cells){
                    $cells->setBackground('#d9d9d9');
                });
                $sheet->cells('A22', function($cells){
                    $cells->setBackground('#d9d9d9');
                });

                $sheet->setBorder('A'.($fila+1).':H'.($fila2), 'thin');
                $sheet->mergeCells('A'.($fila2).':E'.($fila2));
                $sheet->mergeCells('G'.($fila2).':H'.($fila2));
                $sheet->appendRow($fila2, ['Total de Horas Complidas:','','','','',$total]);
                $sheet->cells('A'.($fila2), function($cells){
                    $cells->setBackground('#d9d9d9');
                });

                $sheet->mergeCells('A'.($fila2+2).':H'.($fila2+2));
                $sheet->mergeCells('A'.($fila2+3).':H'.($fila2+3));
                $sheet->setBorder('A'.($fila2+2).':H'.($fila2+3), 'thin');
                $sheet->cells('A'.($fila2+2), function($cells){
                    $cells->setBackground('#d9d9d9');
                    $cells->setValue('Descripción y reflexiones de los aprendizajes obtenidos durante la vinculación:');
                });
                $sheet->appendRow($fila2+3, [$request->reflexiones]);
                $sheet->mergeCells('A'.($fila2+5).':D'.($fila2+5));
                $sheet->mergeCells('E'.($fila2+5).':H'.($fila2+5));
                $sheet->mergeCells('A'.($fila2+6).':D'.($fila2+6));
                $sheet->mergeCells('E'.($fila2+6).':H'.($fila2+6));
                $sheet->setBorder('A'.($fila2+5).':H'.($fila2+6), 'thin');
                $sheet->cells('A'.($fila2+6), function($cells){
                    $cells->setBackground('#d9d9d9');
                    $cells->setValue('Firma del Responsable de la Unidad');
                });
                $sheet->cells('E'.($fila2+6), function($cells){
                    $cells->setBackground('#d9d9d9');
                    $cells->setValue('Firma del Docente');
                });

                $sheet->setHeight(array(
                    ($fila2+3)     =>  111.71,
                    ($fila2+5)     =>  42.71

                ));


                $sheet->setPageMargin(0.33);
                $sheet->setPrintArea('A1:H'.($fila+7));
                $sheet->setHorizontalCentered(true);
                $sheet->setVerticalCentered(false);
            });
        })->store('xlsx', false, true);
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download($export['full'], 200, $headers );


        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function reporte7(Request $request)
    {
        $estudiante = Estudiante::where('idestudiante', $request->estudiante)->get();
        return view('reportes.reporte7', compact('estudiante'));
    }
    public function reporte8(Request $request)
    {
        $estudiante = Estudiante::where('idestudiante', $request->estudiante)->get();
        return view('reportes.reporte8', compact('estudiante'));
    }

    public function reporte9(Request $request)
    {
        $profesor = Profesor::where('idprofesor', $request->profesor)->first();
        return view('reportes.reporte9', compact('profesor'));
    }
    public function reporte10(Request $request)
    {
        $estudiante = Estudiante::where('idestudiante', $request->estudiante)->first();
        return view('reportes.reporte10', compact('estudiante'));
    }
    public function reporte11(Request $request)
    {

        $carreras =Carrera::all();
        $escuelas =Escuela::all();
        $facultades =Facultad::all();
        $sedes =Sede::all();
            $profesor = Profesor::all()->where('iduser','=',Auth::user()->id)->first();
            $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->whereHas('practica', function($query) {
                    $query->where('practica.activapractica', 'TRUE');
                })
                ->where('practica.idprofesor','=',$request->profesor)
                ->groupBy('estudiante.idestudiante')
                ->havingRaw('SUM(practica.horaspractica) > 0')
                ->orderByRaw('SUM(practica.horaspractica)')
                ->get();
            $estudiantes2 = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->whereDoesntHave('practica', function($query) {
                    $query->where('practica.activapractica', 'TRUE');
                })
                ->where('practica.idprofesor','=',$request->profesor)
                ->groupBy('estudiante.idestudiante')
                ->orderByRaw('SUM(practica.horaspractica) ASC')
                ->get();

        return view('reportes.reporte11', compact('estudiantes', 'estudiantes2','carreras', 'escuelas', 'facultades', 'sedes'));
    }

}
