<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    use HasFactory;
    protected $table = 'grupos';

    public $timestamps = false;
    // Establece la clave primaria personalizada
    protected $primaryKey = 'id_grupo';
   
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['id_grupo','id_licenciatura', 'id_rvoe','periodo','anio','cuatrimestre'];
}
