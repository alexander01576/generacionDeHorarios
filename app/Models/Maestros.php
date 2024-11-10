<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestros extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'correo_electronico', 'telefono', 'estatus'];

    // public function asignaciones()
    // {
    //     return $this->hasMany(asignaciones::class, 'profesor_id');
    // }
}
