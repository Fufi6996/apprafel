<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = ['nom_alu', 'llinatges', 'mail', 'dni', 'fecha_nac', 'id_asig'];

    // Un alumno pertenece a una asignatura
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'id_asig');
    }
  //
}
