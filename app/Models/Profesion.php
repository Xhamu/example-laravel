<?php

namespace App\Models;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;

    public $fillable = ['titulo'];

    public function usuarios() {
        return $this->belongsTo(Usuario::class, 'id_profesion');
    }
}
