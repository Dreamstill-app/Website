<?php

namespace App\Policies;

use App\Models\Sort;
use App\Models\User;

class SortPolicy
{
    public function view(User $user, Sort $sort): bool
    {
        return $sort->user_id === $user->id || $user->isAdmin();
    }

    public function update(User $user, Sort $sort): bool
    {
        return $sort->user_id === $user->id;
    }

    public function delete(User $user, Sort $sort): bool
    {
        return $sort->user_id === $user->id || $user->isAdmin();
    }
}
