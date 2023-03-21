<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    use SoftDeletes;

    public $fillable = ['nombre', 'apellidos', 'email'];

    protected $dates = ['fecha'];

    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn (string $nombre, string $apellidos) => ucfirst($nombre) . ucfirst($apellidos),
        );
    }

    public function profesion() {
        return $this->hasOne(Profesion::class, 'id');
    }

    public function getTituloProfesion() {
        return $this->hasOne(Profesion::class, 'id_profesion', 'titulo');
    }

}