<?php

namespace App\Http\Controllers;

use App\Models\Aulas;
use Illuminate\Http\Request;

class AulasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aulas::where('estatus', 1)->get();
        return view('aulas.index', compact('aulas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grupos = Grupos::where('estatus', 1)->get();
        return view('alumnos.create', compact('grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $atributos = $this->validate($request, [
                'matricula' => 'required',
                'nombre' => 'required',
                'apat' => 'required',
                'amat' => 'required',
                'curp' => 'required',
                'sexo' => 'required',
                'correo' => 'required',
                'contacto' => 'required',
                'estatus_inscripcion' => 'required',
                'grupo_id' => 'required',
            ]);

            $Alumnos = Alumnos::create($atributos);

            //Registro del log
            $logController = new LogsController();
            $logController->newLog(
                auth()->user()->id,
                'Alumno -> crear',
                'ID: ' . $Alumnos->id
            );

            return response()->json(['message' => 'Se ha guardado correctamente']);
        } catch (Exception $e) {
            return back()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Aulas $aulas)
    {
        $alumno = Alumnos::where(['id' => $id])->first();
        return view('alumnos.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aulas $aulas)
    {
        $alumno = Alumnos::where(['id' => $id])->first();
        $grupos = Grupos::where('estatus', 1)->get();
        return view('alumnos.edit', compact('alumno', 'grupos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aulas $aulas)
    {
        try {
            $atributos = $this->validate($request, [
                'matricula' => 'required',
                'nombre' => 'required',
                'apat' => 'required',
                'amat' => 'required',
                'curp' => 'required',
                'sexo' => 'required',
                'correo' => 'required',
                'contacto' => 'required',
                'estatus_inscripcion' => 'required',
                'grupo_id' => 'required',
            ]);

            Alumnos::findorfail($id)->update($atributos);

            return response()->json(['message' => 'Alumno actualizado con éxito']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aulas $aulas)
    {

    }
}
