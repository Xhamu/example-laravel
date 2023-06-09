<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $foreignKey = 'user_id';


    protected $fillable = ['user_id', 'product_id', 'cantidad'];

    public function user()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
