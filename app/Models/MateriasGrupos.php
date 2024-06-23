<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriasGrupos extends Model
{
    use HasFactory;
    protected $table = 'materias_grupos';

    public $timestamps = false;
    // Establece la clave primaria personalizada
    protected $primaryKey = 'id';

    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['id_profesor', 'id_materia', 'id_grupo', 'name', 'materia', 'hora'];
}
