<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Summary of Usuario
 */
class Usuario extends Model implements Authenticatable, Authorizable
{
    use HasFactory, Notifiable, HasRoles;

    use SoftDeletes;
    protected $fillable = ['nombre', 'email', 'saldo', 'fecha', 'id_profesion', 'password'];

    protected $dates = ['fecha'];

    public function updateBalance($amount)
    {
        $this->saldo -= $amount;
        $this->save();

        session()->put('saldo', $this->saldo);
    }

    public function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn (string $nombre, string $apellidos) => ucfirst($nombre) . ucfirst($apellidos),
        );
    }

    public function profesion()
    {
        return $this->hasOne(Profesion::class, 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
    /**
     * Determine if the entity has a given ability.
     *
     * @param \Traversable|array|string $abilities
     * @param array|mixed $arguments
     * @return bool
     */
    public function can($abilities, $arguments = array())
    {
    }
}
