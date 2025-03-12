<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjetPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function view(User $user)
    {
        return $this->getPermission($user, 46);
    }
    public function verdict_du_comite_plan_daffaire(User $user)
    {
        return $this->getPermission($user, 36);
    } 
    public function lister_pca_chef_de_zone(User $user)
    {
        return $this->getPermission($user, 43);
    } 
    public function lister_les_projets_soumis(User $user)
    {
        return $this->getPermission($user, 31);
    }
    public function lister_projet_aanalyse_chef_dantenne(User $user)
    {
        return $this->getPermission($user, 32);
    }
    public function lister_projet_analyse_par_chef_dantenne(User $user)
    {
        return $this->getPermission($user, 33);
    }
    public function lister_projet_soumis_au_comite(User $user)
    {
        return $this->getPermission($user, 34);
    }
    public function lister_decision_comite_projet(User $user)
    {
        return $this->getPermission($user,35);
    }
    public function lister_en_attente_du_ses(User $user)
    {
        return $this->getPermission($user,40);
    }
    public function donner_lavis_du_ses(User $user)
    {
        return $this->getPermission($user,41);
    }
    
    public function update(User $user)
    {
        return $this->getPermission($user,56);
    }
    public function lister_chef_de_projet(User $user)
    {
        return $this->getPermission($user, 44);
    }
    public function valider_analyse_pca(User $user)
    {
        return $this->getPermission($user, 50);
    }
    public function enregistrer_kyc(User $user){
        return $this->getPermission($user, 49);
     }
     public function suivre_execution_pca(User $user){
        return $this->getPermission($user, 53);
     }
     public function valider_execution_pca(User $user){
        return $this->getPermission($user, 54);
     }
     public function acceder_pca_selectionnes(User $user)
     {
         return $this->getPermission($user, 58);
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
