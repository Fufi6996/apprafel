<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $fillable = ['nom_prof', 'email_prof'];

    // Un profesor tiene muchas asignaturas
    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'id_prof');
    }
}
