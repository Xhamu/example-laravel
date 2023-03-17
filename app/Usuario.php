<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use SoftDeletes;

    public $fillable = ['nombre', 'apellidos', 'email'];

    protected $dates = ['deleted_at'];
}