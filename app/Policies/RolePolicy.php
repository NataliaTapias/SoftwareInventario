<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->rol->nombre === 'admin';
    }

    public function view(User $user, Role $role)
    {
        return $user->rol->nombre === 'admin';
    }

    public function create(User $user)
    {
        return $user->rol->nombre === 'admin';
    }

    public function update(User $user, Role $role)
    {
        return $user->rol->nombre === 'admin';
    }

    public function delete(User $user, Role $role)
    {
        return $user->rol->nombre === 'admin';
    }

    public function restore(User $user, Role $role)
    {
        return $user->rol->nombre === 'admin';
    }

    public function forceDelete(User $user, Role $role)
    {
        return $user->rol->nombre === 'admin';
    }
}
