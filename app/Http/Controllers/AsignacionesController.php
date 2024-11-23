<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Maestros;
use App\Models\Materias;
use Illuminate\Http\Request;

class AsignacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $asingaciones = Asignaciones::where('estatus', 1)->get();
        return view('controladores.asignaciones.index', compact('asingaciones'));
    }

    public function create()
    {
        $materias = Materias::where('estatus', 1)->get();
        $maestros = Maestros::where('estatus', 1)->get();
        return view('controladores.asignaciones.create', compact('materias', 'maestros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignaciones $asignaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignaciones $asignaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignaciones $asignaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignaciones $asignaciones)
    {
        //
    }
}
