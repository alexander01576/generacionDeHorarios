<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Maestros;
use App\Models\Materias;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $atributos = $this->validate($request, [
                'materia_id' => 'required',
                'maestro_id' => 'required',
            ]);

            $asignacion = Asignaciones::create($atributos);

            //Registro del log
            $ruta = Route::currentRouteName();
            $logController = new LogController();
            $logController->newLog(
                auth()->user()->id,
                $ruta,
                json_encode($atributos)
            );

            DB::commit();
            return response()->json(['message' => 'Se ha guardado correctamente, volviendo al inicio']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
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
