<?php

// app/Policies/TranskripPolicy.php

namespace App\Policies;

use App\Models\transkrip;
use App\Models\User;

class TranskripPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Izinkan semua user untuk melihat daftar transkrip
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, transkrip $transkrip): bool
    {
        return true; // Izinkan semua user untuk melihat detail transkrip
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
{
    return $user->role === 'admin';
}

public function update(User $user, transkrip $transkrip): bool
{
    return $user->role === 'admin';
}

public function delete(User $user, transkrip $transkrip): bool
{
    return $user->role === 'admin';
}
}
