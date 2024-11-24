<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['materia_id', 'profesor_id'];

    public function materia()
    {
        return $this->belongsTo(Materias::class, 'materia_id');
    }

    public function maestro()
    {
        return $this->belongsTo(Maestros::class, 'profesor_id');
    }
}
