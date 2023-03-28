<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Providers\AuthServiceProvider;
use Illuminate\Auth\Access\Response;

class UsuarioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario): bool
    {
        return $usuario->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario): bool
    {
        return $usuario->hasRole('admin');
    }
    
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario): bool
    {
        return $usuario->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario): bool
    {
        return $usuario->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario): bool
    {
        return $usuario->hasRole('admin');
    }
}
