<?php

namespace App\Models;

use App\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;

    public $fillable = ['titulo'];

    public function usuarios() {
        return $this->hasMany(Usuario::class);
    }
}
