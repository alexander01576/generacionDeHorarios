<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Materias;
use App\Models\Semestres;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class MateriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $materias = Materias::where('estatus', 1)->get();
        return view('controladores.materias.index', compact('materias'));
    }

    public function create()
    {
        //variables para las materias (carrera, semestres)
        $carreras = Carreras::where('estatus', 1)->get();
        $semestres = Semestres::where('estatus', 1)->get();
        return view('controladores.materias.create', compact('carreras', 'semestres'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $atributos = $this->validate($request, [
                'nombre' => 'required',
                'carrera_id' => 'required',
                'semestre_id' => 'required',
            ]);

            $materia = Materias::create($atributos);

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

    public function edit(Materias $materia)
    {
        $carreras = Carreras::where('estatus', 1)->get();
        $semestres = Semestres::where('estatus', 1)->get();
        return view('controladores.materias.edit', compact('materia', 'carreras', 'semestres'));
    }

    public function update(Request $request, Materias $materia)
    {
        try {
            DB::beginTransaction();

            $atributos = $this->validate($request, [
                'nombre' => 'required',
                'carrera_id' => 'required',
                'semestre_id' => 'required',
            ]);

            $materia->update($atributos);

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
        $aula1 = Materias::findorfail($id);
        $aula1->estatus = 0;
        $aula1->save();

        // Registro del log
        $logController = new LogController();
        $logController->newLog(
            auth()->user()->id,
            Route::currentRouteName(),
            json_encode($aula1)
        );

        return redirect()->route('materias.index');
    }






}
