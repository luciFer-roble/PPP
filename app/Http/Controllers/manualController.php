<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class manualController extends Controller
{
    public function descargar()
    {
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download(public_path('uploads/manual.pdf'), 'ManualPPP.pdf', $headers );
    }
}
