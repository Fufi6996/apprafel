<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = ['nom_aula', 'id_asig'];

    // Un aula pertenece a una asignatura
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'id_asig');
    }
    //
}
