<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestriccionHorarios extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['maestro_id', 'dia_semana', 'hora_inicio', 'hora_fin', 'estatus'];

    public function maestro()
    {
        return $this->belongsTo(Maestros::class, 'maestro_id');
    }

}
