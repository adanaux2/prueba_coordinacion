<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licenciatura extends Model
{
    use HasFactory;
    protected $table = 'licenciaturas';

    // Establece la clave primaria personalizada
    protected $primaryKey = 'id_licenciatura';
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['id_licenciatura','licenciatura'];
}
