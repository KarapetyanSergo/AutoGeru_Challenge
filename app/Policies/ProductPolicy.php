<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    use HandlesAuthorization;

    public function create(User $user): Response
    {
        return $user->type === User::TYPES['salesman']
        ? Response::allow()
        : Response::deny('You do not have access to create product.');
    }
}
