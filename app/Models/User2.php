<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User2 extends Model
{
    use HasFactory;
    protected $table = 'user';
    public $timestamps = false;

    // Establece la clave primaria personalizada
    protected $primaryKey = 'id';
    // Define los atributos que pueden ser asignados en masa
    protected $fillable = ['name','email'];
}
