<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapaCurricular extends Model
{
    use HasFactory;
    protected $table = 'mapa_curricular';

    public $timestamps = false;
    protected $with = ['materias','profesor'];
    // Establece la clave primaria personalizada
    protected $primaryKey = 'id_mapa';
   
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['id_mapa','id_profe', 'id_materia'];

    public function materias()
    {
        //  Obtener el ID de licenciatura asociado con esta instancia de Licenciatura
        return $this->hasMany(Materias::class, 'id_materia', 'id_materia');
    }
    public function profesor()
    {
        //  Obtener el ID de licenciatura asociado con esta instancia de Licenciatura
        return $this->hasMany(Profesor::class, 'id_profe', 'id_profe');
    }
}
