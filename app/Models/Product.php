<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($product) {
            $users = Usuario::all();
            foreach ($users as $user) {
                $user->orders()->create(['product_id' => $product->id, 'user_id' => $user->id]);
            }
        });
    }
}
