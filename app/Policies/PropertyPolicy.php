<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PropertyPolicy
{
    /**
     * Determine whether the user can view any Property in Properties page.
     */
    public function viewAny(User $user): bool
    {
        //only customers can view /properties page
        return $user->role != 'agent';
    }

    public function manages(User $user){
        return $user->role == 'agent';
    }
    
    public function viewProperty(User $user, Property $property){
        return $user->role == 'agent' && $property->agent_id == $user->id; 
    }
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Property $property): bool
    {
         return $user->role == 'customer';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
         return $user->role == 'agent';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Property $property): bool
    {
        if($user->role == 'agent'){
            return $user->id == $property->agent_id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Property $property): bool
    {
        if($user->role == 'agent'){
            return $property->agent_id == $user->id;
        }

        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Property $property): bool
    {
        if($user->role == 'admin'){
            return $property->is_band;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Property $property): bool
    {
        return false;
    }
}
