<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table = 'roles';

    // Establece la clave primaria personalizada
    protected $primaryKey = 'id_rol';
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['id_rol','rol'];
}
