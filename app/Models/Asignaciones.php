<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['materia_id', 'maestro_id', 'estatus'];

    public function materia()
    {
        return $this->belongsTo(Materias::class, 'materia_id');
    }

    public function maestro()
    {
        return $this->belongsTo(Maestros::class, 'maestro_id');
    }
}
