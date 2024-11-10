<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'estatus'];

    public function materias()
    {
        return $this->hasMany(materias::class, 'id');
    }
}
