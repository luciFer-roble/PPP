<?php

namespace App\Http\Controllers;

use App\Malla;
use Illuminate\Http\Request;

class MallaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Malla  $malla
     * @return \Illuminate\Http\Response
     */
    public function show(Malla $malla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Malla  $malla
     * @return \Illuminate\Http\Response
     */
    public function edit(Malla $malla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Malla  $malla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Malla $malla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Malla  $malla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Malla $malla)
    {
        //
    }
}
