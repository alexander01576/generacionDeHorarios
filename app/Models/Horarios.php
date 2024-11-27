<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['dia_semana', 'hora_inicio', 'hora_fin', 'aula_id', 'asignacion_id', 'periodo_id', 'estatus'];

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'aula_id');
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignaciones::class, 'asignacion_id');
    }

    public function periodo()
    {
        return $this->belongsTo(PeriodosAcademicos::class, 'periodo_id');
    }
}
