<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'direccion', 'logotipo', 'email', 'telefono', 'web'];

    public function alumnos(){
        return $this->hasMany(Alumno::class);
    }
}
