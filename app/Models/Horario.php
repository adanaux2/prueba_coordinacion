<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horarios';

    // Establece la clave primaria personalizada
    protected $primaryKey = 'id_horario';
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['dia','hora'];
}
