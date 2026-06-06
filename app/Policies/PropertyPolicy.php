<?php
// app/Policies/PropertyPolicy.php
namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    // ✅ Admins, agents ET owners peuvent publier des annonces
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'agent', 'owner']);
    }

    // Seul l'auteur ou l'admin peut modifier
    public function update(User $user, Property $property): bool
    {
        return $user->role === 'admin' || $property->user_id === $user->id;
    }

    // Seul l'auteur ou l'admin peut supprimer
    public function delete(User $user, Property $property): bool
    {
        return $user->role === 'admin' || $property->user_id === $user->id;
    }
}
