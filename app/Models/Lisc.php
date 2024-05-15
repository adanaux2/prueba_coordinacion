<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lisc extends Model
{
    use HasFactory;

    protected $table = 'licenciaturas';

    // Establece la clave primaria personalizada
    protected $primaryKey = 'id_licenciatura';
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['id_licenciatura', 'licenciatura'];
    protected $with = ['rvoe'];

    public function rvoe()
    {
        return $this->hasMany(Licenciaturas_rvoe::class, 'id_licenciatura', 'id_licenciatura');
    }
}
