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

    public function edit(Asignaciones $asignacione)
    {
        $materias = Materias::where('estatus', 1)->get();
        $maestros = Maestros::where('estatus', 1)->get();
        return view('controladores.asignaciones.edit', compact('asignacione', 'materias', 'maestros'));
    }

    public function update(Request $request, Asignaciones $asignacione)
    {
        try {
            DB::beginTransaction();

            $atributos = $this->validate($request, [
                'materia_id' => 'required',
                'maestro_id' => 'required',
            ]);

            $asignacione->update($atributos);

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

    public function destroy($id)
    {
        $valor = Asignaciones::findorfail($id);
        $valor->estatus = 0;
        $valor->save();

        // Registro del log
        $logController = new LogController();
        $logController->newLog(
            auth()->user()->id,
            Route::currentRouteName(),
            json_encode($valor)
        );

        return redirect()->route('asignaciones.index');
    }
}
