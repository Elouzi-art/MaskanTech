<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    /** Admins peuvent tout faire */
    public function before(User $user): ?bool
    {
        if ($user->isAdmin()) return true;
        return null;
    }

    /** Agents ET propriétaires peuvent créer des annonces */
    public function create(User $user): bool
    {
        return $user->isAgent() || $user->isOwner();
    }

    /** L'agent/propriétaire auteur peut modifier */
    public function update(User $user, Property $property): bool
    {
        return ($user->isAgent() || $user->isOwner()) && $property->user_id === $user->id;
    }

    /** Même règle pour la suppression */
    public function delete(User $user, Property $property): bool
    {
        return ($user->isAgent() || $user->isOwner()) && $property->user_id === $user->id;
    }

    /** Tout le monde peut voir */
    public function view(?User $user, Property $property): bool
    {
        return true;
    }
}
