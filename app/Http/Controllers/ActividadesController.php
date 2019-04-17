<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Practica;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;

class ActividadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Practica $practica)
    {
        $actividades = Actividad::where('idpractica', '=' , $practica->idpractica )->orderBy('idactividad')->paginate(5);
        return view('actividades.index', compact('practica', 'actividades'));
    }
    public function store($practica, $total)
    {

        //echo $total; exit();
        // store
        for ($i = 0; $i < 5; $i++){

            Actividad::create([
                'idpractica'       => $practica,
                'semanaactividad'       => ($total + 1),
            ]);
        }

        // redirect
        return redirect('actividades/'.$practica.'/list?page='.($total+1));

    }
    public function store2($profesor)
    {
            $actividad = Actividad::create([
                'idprofesor'       => $profesor
            ]);
        return $actividad;

    }
    public function update(Request $request, $id)
    {
        //var_dump($request->fecha); exit();


        // store
        Actividad::updateOrCreate(['idactividad'  => $id], [
            'descripcionactividad'       => request('descripcion'),
            'fechaactividad'       => request('fecha'),
            'comentarioactividad'      => request('comentario'),
            'estadoactividad'      => request('estado'),
            'horasactividad'      => request('horas')
        ]);

        // redirect
        return 'true';
    }

    public function descargar(Request $request)
    {
        $inicio = (($request->pagina)-1)*5;
        $actividades = Actividad::where('idpractica', '=' , $request->practica )->orderBy('idactividad')->skip($inicio)->take(5)->get();

        /*foreach ($actividades as $actividade){
            var_dump($actividade->idactividad);
        } exit();*/
        Excel::create('ActividadesSemana', function ($excel) use($actividades){
            $excel->sheet('Reporte', function ($sheet) use ($actividades){
                $sheet->setWidth(array(
                    'A'     =>  2.49,
                    'B'     =>  3.93,
                    'C'     =>  3.93,
                    'D'     =>  3.93,
                    'E'     =>  4.6,
                    'F'     =>  3.49,
                    'G'     =>  3.27,
                    'H'     =>  13.49,
                    'I'     =>  11.38,
                    'J'     =>  11.38,
                    'K'     =>  9.93,
                    'L'     =>  14.93,
                    'M'     =>  2.38,
                    'N'     =>  1.52,
                    'O'     =>  9.49,
                    'P'     =>  9.27,
                    'Q'     =>  4.6,
                    'R'     =>  4.6,
                    'S'     =>  4.49,
                    'T'     =>  5.82,
                    'U'     =>  4.82,
                    'V'     =>  3.93,
                    'W'     =>  4.6,
                    'X'     =>  4.6,
                    'Y'     =>  3.27,
                    'Z'     =>  3.27,
                    'AA'     =>  3.27
                ));
                $sheet->setHeight(array(
                    16     =>  8.21,
                    18     =>  6.71,
                    20     =>  35.81,
                    21     =>  35.81,
                    22     =>  35.81,
                    23     =>  35.81,
                    24     =>  35.81,
                    25     =>  35.81,
                    26     =>  35.81

                ));
                $sheet->cells('B5:AA7', function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('B9:M15', function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('O9:AA15', function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('K17:AA17', function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('Q14:S14', function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('V14:X14', function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->setBorder('U2:U3', 'thin');
                $sheet->setBorder('F12:F14', 'thin');
                $sheet->setBorder('B19:AA26', 'thin');
                $sheet->mergeCells('A1:D4');
                $sheet->mergeCells('E1:V1');
                $sheet->mergeCells('W1:AA4');
                $sheet->mergeCells('E2:O2');
                $sheet->mergeCells('P2:T2');
                $sheet->mergeCells('E3:O3');
                $sheet->mergeCells('P3:T3');
                $sheet->mergeCells('B5:L5');
                $sheet->mergeCells('P5:S5');
                $sheet->mergeCells('T5:U5');
                $sheet->mergeCells('V5:Z5');
                $sheet->mergeCells('B6:C6');
                $sheet->mergeCells('D6:L6');
                $sheet->mergeCells('P6:S6');
                $sheet->mergeCells('T6:U6');
                $sheet->mergeCells('V6:Z6');
                $sheet->mergeCells('B7:C7');
                $sheet->mergeCells('D7:L7');
                $sheet->mergeCells('P7:Z7');
                $sheet->mergeCells('B9:H9');
                $sheet->mergeCells('I9:L9');
                $sheet->mergeCells('O9:Z9');
                $sheet->mergeCells('B10:H10');
                $sheet->mergeCells('I10:L10');
                $sheet->mergeCells('P10:Z10');
                $sheet->mergeCells('B11:E11');
                $sheet->mergeCells('P11:Z11');
                $sheet->mergeCells('B12:E12');
                $sheet->mergeCells('I12:L12');
                $sheet->mergeCells('B13:E13');
                $sheet->mergeCells('I13:L13');
                $sheet->mergeCells('O13:Z13');
                $sheet->mergeCells('B14:E14');
                $sheet->mergeCells('I14:L14');
                $sheet->mergeCells('Q14:S14');
                $sheet->mergeCells('T14:U14');
                $sheet->mergeCells('V14:Y14');
                $sheet->mergeCells('Q15:S15');
                $sheet->mergeCells('V15:Y15');
                $sheet->mergeCells('B17:J17');
                $sheet->mergeCells('K17:Z17');
                $sheet->mergeCells('B19:D19');
                $sheet->mergeCells('E19:R19');
                $sheet->mergeCells('S19:V19');
                $sheet->mergeCells('W19:AA19');
                $sheet->mergeCells('B20:D20');
                $sheet->mergeCells('E20:R20');
                $sheet->mergeCells('S20:V20');
                $sheet->mergeCells('W20:AA20');
                $sheet->mergeCells('B21:D21');
                $sheet->mergeCells('E21:R21');
                $sheet->mergeCells('S21:V21');
                $sheet->mergeCells('W21:AA21');
                $sheet->mergeCells('B22:D22');
                $sheet->mergeCells('E22:R22');
                $sheet->mergeCells('S22:V22');
                $sheet->mergeCells('W22:AA22');
                $sheet->mergeCells('B23:D23');
                $sheet->mergeCells('E23:R23');
                $sheet->mergeCells('S23:V23');
                $sheet->mergeCells('W23:AA23');
                $sheet->mergeCells('B24:D24');
                $sheet->mergeCells('E24:R24');
                $sheet->mergeCells('S24:V24');
                $sheet->mergeCells('W24:AA24');
                $sheet->mergeCells('B25:D25');
                $sheet->mergeCells('E25:R25');
                $sheet->mergeCells('S25:V25');
                $sheet->mergeCells('W25:AA25');
                $sheet->mergeCells('B26:D26');
                $sheet->mergeCells('E26:R26');
                $sheet->mergeCells('S26:V26');
                $sheet->mergeCells('W26:AA26');
                $sheet->mergeCells('B27:D27');
                $sheet->mergeCells('B29:H29');
                $sheet->mergeCells('I29:J29');
                $sheet->mergeCells('P29:V29');
                $sheet->mergeCells('I30:J30');
                $sheet->mergeCells('P30:V30');
                $sheet->mergeCells('B32:AA32');
                $sheet->cells('E1', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(14);
                    $cells->setValue('PONTIFICIA UNIVERSIDAD CATOLICA DEL ECUADOR');
                });
                $sheet->cells('E2', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(13);
                    $cells->setValue($actividades[0]->practica->estudiante->carrera->escuela->facultad->nombrefacultad);
                });
                $sheet->cells('E3', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(13);
                    $cells->setValue($actividades[0]->practica->estudiante->carrera->nombrecarrera);
                });
                $sheet->cells('P2', function($cells) {
                    $cells->setValue('Modalidad Intersemestral');
                });
                $sheet->cells('P3', function($cells) {
                    $cells->setValue('Modalidad Paralela');
                });
                $sheet->cells('B5', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(11);
                    $cells->setValue('DATOS DEL ESTUDIANTE');
                });
                $sheet->cells('B6', function($cells) use ($actividades) {
                    $cells->setValue('Nombre:');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('B7', function($cells) use ($actividades) {
                    $cells->setValue('Nivel:');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('O5', function($cells) use ($actividades) {
                    $cells->setValue('Cedula:');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('O6', function($cells) use ($actividades) {
                    $cells->setValue('Telefono:');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('O7', function($cells) use ($actividades) {
                    $cells->setValue('e-mail:');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('T6', function($cells) use ($actividades) {
                    $cells->setValue('Celular:');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('V6', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setValue($actividades[0]->practica->estudiante->celularestudiante);
                });
                $sheet->cells('D6', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setValue($actividades[0]->practica->estudiante->apellidosestudiante.' '.$actividades[0]->practica->estudiante->nombresestudiante);
                });
                $sheet->cells('D7', function($cells) use ($actividades) {
                    $cells->setValue($actividades[0]->practica->nivel->nombrenivel);
                });
                $sheet->cells('P5', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setValue($actividades[0]->practica->estudiante->cedulaestudiante);
                });
                $sheet->cells('P6', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setValue($actividades[0]->practica->estudiante->celularestudiante);
                });
                $sheet->cells('P7', function($cells) use ($actividades) {
                    $cells->setFontColor('#0000ff');
                    $cells->setAlignment('center');
                    $cells->setValue($actividades[0]->practica->estudiante->correoestudiante);
                });

                $sheet->cells('B9', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(11);
                    $cells->setValue('NOMBRE DE LA EMPRESA O INSTITUCION');
                });
                $sheet->cells('B10', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(11);
                    $cells->setValue('NOMBRE DEL EJECUTIVO(Contacto)');
                });
                $sheet->cells('I9', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setValue($actividades[0]->practica->tutore->empresa->nombreempresa);
                });
                $sheet->cells('I10', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setValue($actividades[0]->practica->tutore->nombretutore.' '.$actividades[0]->practica->tutore->apellidotutore);
                });
                $sheet->cells('B11', function($cells) use ($actividades) {
                    $cells->setAlignment('right');
                    $cells->setValue('Publica');
                });
                $sheet->cells('B12', function($cells) use ($actividades) {
                    $cells->setAlignment('right');
                    $cells->setValue('Privada');
                });
                $sheet->cells('B13', function($cells) use ($actividades) {
                    $cells->setAlignment('right');
                    $cells->setValue('E. No Lucrativa');
                });
                $sheet->cells('B14', function($cells) use ($actividades) {
                    $cells->setAlignment('right');
                    $cells->setValue('O. Internacional');
                });
                $sheet->cells('F12:F14', function($cells) use ($actividades) {
                    $cells->setBorder('solid');
                });
                $sheet->cells('H12', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setValue('Direccion:');
                });
                $sheet->cells('H13', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setValue('Telefonos:');
                });
                $sheet->cells('H14', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setValue('e-mail:');
                });
                $sheet->cells('I12', function($cells) use ($actividades) {
                    $cells->setValue($actividades[0]->practica->tutore->empresa->direccionempresa);
                });
                $sheet->cells('I13', function($cells) use ($actividades) {
                    $cells->setValue($actividades[0]->practica->tutore->celulartutore);
                });
                $sheet->cells('I14', function($cells) use ($actividades) {
                    $cells->setFontColor('#0000ff');
                    $cells->setAlignment('center');
                    $cells->setValue($actividades[0]->practica->tutore->correotutore);
                });
                $sheet->cells('O9', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(11);
                    $cells->setValue('DATOS PROYECTO');
                });
                $sheet->cells('O10', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setValue('Direccion:');
                });
                $sheet->cells('O11', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setValue('Telefono:');
                });
                $sheet->cells('O13', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setValue('Periodo de ejecucion de la practica');
                });
                $sheet->cells('P10', function($cells) use ($actividades) {
                    $cells->setValue($actividades[0]->practica->tutore->empresa->direccionempresa);
                });
                $sheet->cells('P11', function($cells) use ($actividades) {
                    $cells->setValue($actividades[0]->practica->tutore->empresa->telefonoempresa);
                });
                $sheet->cells('P14', function($cells) use ($actividades) {
                    $cells->setValue('Desde:');
                    $cells->setAlignment('right');
                });
                $sheet->cells('Q14', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setValue($actividades[0]->practica->fechainiciopractica);
                });
                $sheet->cells('T14', function($cells) use ($actividades) {
                    $cells->setAlignment('right');
                    $cells->setValue('Hasta:');
                });
                $sheet->cells('V14', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setValue($actividades[0]->practica->fechafinpractica);
                });
                $sheet->cells('Q15', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setValue('(dd/mm/aaaa)');
                });
                $sheet->cells('V15', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setValue('(dd/mm/aaaa)');
                });
                $sheet->cells('B17', function($cells) use ($actividades) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(12);
                    $cells->setValue('NOMBRE DEL PROYECTO EN EL QUE SE REALIZA LA PRACTICA');
                });
                $sheet->cells('K17', function($cells) use ($actividades) {
                    $cells->setAlignment('center');
                    $cells->setFontSize(14);
                    $cells->setFontWeight('bold');
                    $cells->setValue($actividades[0]->practica->tipopractica.' '.$actividades[0]->practica->tutore->empresa->nombreempresa);
                });
                //marcar tipo de empresa
                if($actividades[0]->practica->tutore->empresa->tipoempresa == 'Publica'){
                    $sheet->cells('F11', function($cells){
                        $cells->setValue('X');
                    });
                }
                if($actividades[0]->practica->tutore->empresa->tipoempresa == 'Privada'){
                    $sheet->cells('F12', function($cells){
                        $cells->setValue('X');
                    });
                }
                if($actividades[0]->practica->tutore->empresa->tipoempresa == 'Empresa Sin Fines de Lucro'){
                    $sheet->cells('F13', function($cells){
                        $cells->setValue('X');
                    });
                }
                if($actividades[0]->practica->tutore->empresa->tipoempresa == 'Organismo Internacional'){
                    $sheet->cells('F14', function($cells){
                        $cells->setValue('X');
                    });
                }
                //fin
                //marcar modalidad
                if(strpos($actividades[0]->practica->periodoacademico->descripcionperiodoacademico, 'acacional')){
                    $sheet->cells('U2', function($cells){
                        $cells->setValue('X');
                    });
                }else{
                    $sheet->cells('U3', function($cells){
                        $cells->setValue('X');
                    });
                }
                //fin
                $sheet->cells('U2', function($cells){
                    $cells->setAlignment('center');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('U3', function($cells){
                    $cells->setAlignment('center');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('F11', function($cells){
                    $cells->setAlignment('center');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('F12', function($cells){
                    $cells->setAlignment('center');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('F13', function($cells){
                    $cells->setAlignment('center');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('F14', function($cells){
                    $cells->setAlignment('center');
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('Q14:S14', function($cells){
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('V14:X14', function($cells){
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('Z14', function($cells){
                    $cells->setBorder('none', 'none', 'none', 'thin');
                });
                $sheet->cells('T14', function($cells){
                    $cells->setBorder('none', 'none', 'none', 'thin');
                });




                $sheet->cells('B19', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(11);
                    $cells->setValue('FECHA');
                });
                $sheet->cells('E19', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(11);
                    $cells->setValue('DESCRIPCION DE ACTIVIDADES');
                });
                $sheet->cells('S19', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(11);
                    $cells->setValue('FIRMA DE CONTROL');
                });
                $sheet->cells('W19', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(11);
                    $cells->setValue('COMENTARIOS');
                });
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(10);
                $numero = 20;
                foreach ($actividades as $actividad){
                    $sheet->cells('B'.$numero, function($cells)use($actividad) {
                        $cells->setValignment('center');
                        $cells->setValue($actividad->fechaactividad);
                    });
                    $sheet->cells('E'.$numero, function($cells)use($actividad) {
                        $cells->setValignment('center');
                        $cells->setValue($actividad->descripcionactividad);
                    });
                    $sheet->cells('W'.$numero, function($cells)use($actividad) {
                        $cells->setValignment('center');
                        $cells->setValue($actividad->comentarioactividad);
                    });
                    $numero++;
                }

                $sheet->cells('B27', function($cells){
                    $cells->setAlignment('center');
                    $cells->setValue('(dd/mm/aaaa)');
                });
                $sheet->cells('B29', function($cells){
                    $cells->setAlignment('right');
                    $cells->setValue('Fecha de entrega del informe:');
                });
                $sheet->cells('I30', function($cells){
                    $cells->setAlignment('center');
                    $cells->setFontSize(9);
                    $cells->setValue('(dd/mm/aaaa)');
                });
                $sheet->cells('P30', function($cells){
                    $cells->setAlignment('center');
                    $cells->setFontSize(9);
                    $cells->setValue('Coodinador de PPP');
                });
                $sheet->cells('B32', function($cells){
                    $cells->setAlignment('center');
                    $cells->setFontSize(10);
                    $cells->setValue('Formulario de avance de la Practica a ser presentado Semanalmente');
                });
                $sheet->cells('I29:J29', function($cells){
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('K29', function($cells){
                    $cells->setBorder('none', 'none', 'none', 'thin');
                });
                $sheet->cells('P29:V29', function($cells){
                    $cells->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->cells('B32:AA32', function($cells){
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cells('AB32', function($cells){
                    $cells->setBorder('none', 'none', 'none', 'thin');
                });
                $sheet->cells('D6:L6', function($cells){
                    $cells->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->cells('P5:S5', function($cells){
                    $cells->setBorder('thin', 'none', 'thin', 'none');
                });
                $sheet->cells('P6:S6', function($cells){
                    $cells->setBorder('thin', 'none', 'thin', 'none');
                });
                $sheet->cells('V6:Z6', function($cells){
                    $cells->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->cells('I9:L9', function($cells){
                    $cells->setBorder('thin', 'none', 'thin', 'none');
                });
                $sheet->cells('I10:L10', function($cells){
                    $cells->setBorder('thin', 'none', 'thin', 'none');
                });
                $sheet->cells('I12:L12', function($cells){
                    $cells->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->cells('I13:L13', function($cells){
                    $cells->setBorder('thin', 'none', 'thin', 'none');
                });
                $sheet->cells('I14:L14', function($cells){
                    $cells->setBorder('thin', 'none', 'thin', 'none');
                });
                $sheet->cells('P10:Z10', function($cells){
                    $cells->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->cells('P11:Z11', function($cells){
                    $cells->setBorder('thin', 'none', 'thin', 'none');
                });
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/logo-puce.png'));
                $objDrawing->setCoordinates('B1');
                $objDrawing->setHeight(90);
                $objDrawing->setWidth(90);
                $objDrawing->setWorksheet($sheet);

                $objDrawing2 = new PHPExcel_Worksheet_Drawing;
                $objDrawing2->setPath(public_path('images/logo-ingenieria.png'));
                $objDrawing2->setCoordinates('W1');
                $objDrawing2->setHeight(90);
                $objDrawing2->setWidth(90);
                $objDrawing2->setWorksheet($sheet);

                $sheet->setOrientation('landscape');
                $sheet->setPageMargin(0.33);
                $sheet->setPrintArea('B1:AA32');
                $sheet->setHorizontalCentered(true);
                $sheet->setVerticalCentered(true);

            });
        })->export('xlsx');
    }
}
