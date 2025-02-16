<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = ['nom_asig', 'id_prof'];

    // Una asignatura pertenece a un profesor
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'id_prof');
    }

    // Una asignatura tiene muchas aulas
    public function aulas()
    {
        return $this->hasMany(Aula::class, 'id_asig');
    }

    // Una asignatura tiene muchos alumnos
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_asignatura', 'id_asig', 'id_alum');
    }
}
