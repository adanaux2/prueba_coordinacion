<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    use HasFactory;

    protected $table = 'disponibilidad';

    // Establece la clave primaria personalizada
    protected $primaryKey = 'id_disp';

    protected $with = ['horario'];
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['id_profesor','id_horario','turno'];


    public function horario()
    {
        //  Obtener el ID de licenciatura asociado con esta instancia de Licenciatura
        return $this->hasMany(Horario::class, 'id_horario', 'id_horario');
    }
}

