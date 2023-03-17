<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Usuario extends Model
{
    use SoftDeletes;

    public $fillable = ['nombre', 'apellidos', 'email'];

    protected $dates = ['deleted_at'];

    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn (string $nombre, string $apellidos) => ucfirst($nombre) . ucfirst($apellidos),
        );
    }

}
