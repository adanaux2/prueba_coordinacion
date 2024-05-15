<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    use HasFactory;
    protected $table = 'materias';

    public $timestamps = false;
    // Establece la clave primaria personalizada
    protected $primaryKey = 'id_materia';
   
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['id_materia','materia', 'name','id_rvoe'];
}