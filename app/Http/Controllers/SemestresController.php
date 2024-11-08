<?php

namespace App\Http\Controllers;

use App\Models\Semestres;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SemestresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $semestres = Semestres::where('estatus', 1)->get();
        return view('controladores.semestres.index', compact('semestres'));
    }

    public function create()
    {
        return view('controladores.semestres.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $atributos = $this->validate($request, [
                'nombre' => 'required',
            ]);

            $semestre = Semestres::create($atributos);

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


    public function edit(Semestres $semestre)
    {
        return view('controladores.semestres.edit', compact('semestre'));
    }

    public function update(Request $request, Semestres $semestre)
    {
        try {
            DB::beginTransaction();

            $atributos = $this->validate($request, [
                'nombre' => 'required',
            ]);

            $semestre->update($atributos);

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
        $valor = Semestres::findorfail($id);
        $valor->estatus = 0;
        $valor->save();

        // Registro del log
        $logController = new LogController();
        $logController->newLog(
            auth()->user()->id,
            Route::currentRouteName(),
            json_encode($valor)
        );

        return redirect()->route('semestres.index');
    }}
