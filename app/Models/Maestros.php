<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestros extends Model
{
    use HasFactory;

    protected $table = 'maestros';

    // Establece la clave primaria personalizada
    protected $primaryKey = 'matricula';
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['nombre', 'apellido_p', 'apellido_m', 'correo', 'curp'];
}
