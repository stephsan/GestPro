<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlaintePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function lister(User $user){
        return $this->getPermission($user,37);
     }
     public function visuliser(User $user){
        return $this->getPermission($user,38);
     }
     public function changer_statut(User $user){
        return $this->getPermission($user,39);
     }
    public function getPermission($user,$permission_id){
        foreach($user->roles as $user_role){
            foreach($user_role->permissions as $permission_role){
                if($permission_role->id == $permission_id){
                    return true;
                }
        }
    }
    return false;
}
}
