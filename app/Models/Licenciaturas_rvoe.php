<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licenciaturas_rvoe extends Model
{
    use HasFactory;
    protected $table = 'licenciaturas_rvoe';

    // Establece la clave primaria personalizada
    protected $primaryKey = 'id';
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['id','id_licenciatura', 'id_rvoe'];
    protected $with = ['materias'];
    // Define los atributos que pueden ser asignados en masa



    public function materias()
    {
        //  Obtener el ID de licenciatura asociado con esta instancia de Licenciatura
        return $this->hasMany(Materias::class, 'id_rvoe', 'id_rvoe');
    }
}
