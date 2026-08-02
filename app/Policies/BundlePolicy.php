<?php

namespace App\Policies;

use App\Models\Bundle;
use App\Models\User;

class BundlePolicy
{
    public function view(User $user, Bundle $bundle): bool
    {
        return $bundle->user_id === $user->id || $user->isAdmin();
    }

    public function update(User $user, Bundle $bundle): bool
    {
        return $bundle->user_id === $user->id;
    }

    public function delete(User $user, Bundle $bundle): bool
    {
        return $bundle->user_id === $user->id;
    }
}
