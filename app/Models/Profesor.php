<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $table = "profesores";

    protected $primaryKey = "id_profe";
    protected $with = ['disponibilidad'];
    protected $fillable = ['nombre_c', 'curp'];

    public function disponibilidad()
    {
        //  Obtener el ID de licenciatura asociado con esta instancia de Licenciatura
        return $this->hasMany(Disponibilidad::class, 'id_profe', 'id_profe');
    }
}
