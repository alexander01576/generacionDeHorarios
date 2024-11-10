<?php

namespace App\Http\Controllers;

use App\Models\Maestros;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MaestrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $Maestros = Maestros::where('estatus', 1)->get();
        return view('controladores.maestros.index', compact('Maestros'));
    }

    public function create()
    {
        return view('controladores.maestros.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $atributos = $this->validate($request, [
                'nombre' => 'required',
                'correo_electronico' => 'required',
                'telefono' => 'required',
            ]);

            $Maestros = Maestros::create($atributos);

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

    public function edit(Maestros $Maestro)
    {
        return view('controladores.maestros.edit', compact('Maestro'));
    }

    public function update(Request $request, Maestros $Maestro)
    {
        try {
            DB::beginTransaction();

            $atributos = $this->validate($request, [
                'nombre' => 'required',
                'correo_electronico' => 'required',
                'telefono' => 'required',
            ]);

            // dd($request->all(), $atributos);

            $Maestro->update($atributos);

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
        $valor = Maestros::findorfail($id);
        $valor->estatus = 0;
        $valor->save();

        // Registro del log
        $logController = new LogController();
        $logController->newLog(
            auth()->user()->id,
            Route::currentRouteName(),
            json_encode($valor)
        );

        return redirect()->route('maestros.index');
    }
}
