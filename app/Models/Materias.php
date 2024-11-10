<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'carrera_id', 'semestre_id', 'estatus'];

    public function carrera()
    {
        return $this->belongsTo(Carreras::class, 'carrera_id');
    }

    public function semestre()
    {
        return $this->belongsTo(Semestres::class, 'semestre_id');
    }

    // public function asignaciones()
    // {
    //     return $this->hasMany(asignaciones::class, 'materia_id');
    // }

}
