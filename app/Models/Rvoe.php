<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rvoe extends Model
{
    use HasFactory;
    protected $table = 'rvoe';

    // Establece la clave primaria personalizada
    protected $primaryKey = 'id_rvoe';
    // Indica que la llave primaria no es un entero
    protected $keyType = 'string';

    // Desactiva el incremento automático de la llave primaria
    public $incrementing = false;
    protected $with = ['listaMaterias'];
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['id_rvoe', 'nombre'];

    public function listaMaterias()
    {
        return $this->hasMany(Materias::class, 'id_rvoe', 'id_rvoe');
    }
}
