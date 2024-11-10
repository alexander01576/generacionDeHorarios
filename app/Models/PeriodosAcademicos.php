<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodosAcademicos extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin', 'estatus'];
}
    