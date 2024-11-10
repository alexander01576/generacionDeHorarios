<?php

namespace App\Http\Controllers;

use App\Models\PeriodosAcademicos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class PeriodosAcademicosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $periodos = PeriodosAcademicos::where('estatus', 1)->get();
        return view('controladores.periodosAcademicos.index', compact('periodos'));
    }


    public function create()
    {
        return view('controladores.periodosAcademicos.create');
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $atributos = $this->validate($request, [
                'nombre' => 'required',
                'fecha_inicio' => 'required',
                'fecha_fin' => 'required',
            ]);

            $periodo = PeriodosAcademicos::create($atributos);

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

    public function edit(PeriodosAcademicos $periodo)
    {
        return view('controladores.periodosAcademicos.edit', compact('periodo'));
    }


    public function update(Request $request, PeriodosAcademicos $periodo)
    {
        try {
            DB::beginTransaction();

            $atributos = $this->validate($request, [
                'nombre' => 'required',
                'fecha_inicio' => 'required',
                'fecha_fin' => 'required',
            ]);

            // dd($request->all(), $atributos);

            $periodo->update($atributos);

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
        $valor = PeriodosAcademicos::findorfail($id);
        $valor->estatus = 0;
        $valor->save();

        // Registro del log
        $logController = new LogController();
        $logController->newLog(
            auth()->user()->id,
            Route::currentRouteName(),
            json_encode($valor)
        );

        return redirect()->route('periodos.index');
    }
}
