<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Role extends Model
{
    use HasFactory, HasRoles;
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'role_usuario');
    }
}
