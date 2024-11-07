<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class AulaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $aula = Aula::where('estatus', 1)->get();
        return view('controladores.aulas.index', compact('aula'));
    }

    public function create()
    {
        return view('controladores.aulas.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $atributos = $this->validate($request, [
                'nombre' => 'required',
                'capacidad' => 'required',
                'ubicacion' => 'required',
            ]);

            $aula = Aula::create($atributos);

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

    public function show(Aula $aula)
    {
        /*$alumno = Alumnos::where(['id' => $id])->first();
        return view('alumnos.show', compact('alumno'));*/
    }

    public function edit(Aula $aula)
    {
        return view('controladores.aulas.edit', compact('aula'));
    }

    public function update(Request $request, Aula $aula)
    {
        try {
            DB::beginTransaction();

            $atributos = $this->validate($request, [
                'nombre' => 'required',
                'capacidad' => 'required',
                'ubicacion' => 'required',
            ]);

            $aula->update($atributos);

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
        $aula1 = Aula::findorfail($id);
        $aula1->estatus = 0;
        $aula1->save();

        // Registro del log
        $logController = new LogController();
        $logController->newLog(
            auth()->user()->id,
            Route::currentRouteName(),
            json_encode($aula1)
        );

        return redirect()->route('aulas.index');
    }
}
