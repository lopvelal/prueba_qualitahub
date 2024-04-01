<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellidos', 'fecha_nacimiento', 'ciudad_natal', 'escuela_id'];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }
}
