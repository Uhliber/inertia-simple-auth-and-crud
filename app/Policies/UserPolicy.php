<?php

namespace App\Policies;

use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->email === 'admin@test.com';
    }

    public function edit(User $user, User $model)
    {
        return $user->id === $model->id;
    }
}
