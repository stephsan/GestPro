<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SouscriptionPolicy
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
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $this->getPermission($user,4);
    }
   public function lister_souscription_pe(User $user){
      return $this->getPermission($user,2);
   }
   public function lister_souscription_fp(User $user){
      return $this->getPermission($user,1);
   }
   public function lister_avant_projet_a_evaluer_fp(User $user){
      return $this->getPermission($user,8);
   }
   public function lister_avant_projet_evalues_fp(User $user){
      return $this->getPermission($user,9);
   }
   public function lister_avant_projet_selectionnes_fp(User $user){
      return $this->getPermission($user,10);
   }
   public function lister_avant_projet_selectionnes_pe(User $user){
      return $this->getPermission($user,10);
   }
   public function lister_avant_projet_soumis_au_comite_fp(User $user){
      return $this->getPermission($user,11);
   }
   public function valider_levaluation_de_lavant_projet_fp(User $user){
      return $this->getPermission($user,13);
   }
   public function donner_lavis_de_lequipe_fp(User $user){
      return $this->getPermission($user,14);
   }
   public function donner_lavis_de_lequipe_pe(User $user){
      return $this->getPermission($user,26);
   }
   public function evaluer_souscription(User $user){
      return $this->getPermission($user,3);
   }
   public function valider_la_decision_du_comite(User $user){
      return $this->getPermission($user,15);
   }
   public function valider_la_decision_du_comite_pe(User $user){
      return $this->getPermission($user,27);
   }
   public function valider_leligibilite_fp(User $user){
      return $this->getPermission($user,16);
   }
   public function lister_avant_projet_ineligible(User $user){
      return $this->getPermission($user,17);
   }
   public function lister_avant_projet_a_evaluer_pe(User $user){
      return $this->getPermission($user,18);
   }
   public function lister_avant_projet_evalues_pe(User $user){
      return $this->getPermission($user,19);
   }
   public function valider_levaluation_de_lavant_projet_pe(User $user){
      return $this->getPermission($user,25);
   }
   public function lister_avant_projet_soumis_au_comite_pe(User $user){
      return $this->getPermission($user,20);
   }
   public function lister_avant_projet_selectionne_pe(User $user){
      return $this->getPermission($user,22);
   }
   public function evaluer_souscription_pe(User $user){
      return $this->getPermission($user,22);
   }
   public function valider_leligibilite_pe(User $user){
      return $this->getPermission($user,23);
   }
   public function lister_avant_projet_ineligible_pe(User $user){
      return $this->getPermission($user,24);
   }
   public function visualiser_historique_de_traitement(User $user){
      return $this->getPermission($user,30);
   }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $this->getPermission($user,5);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $this->getPermission($user,5);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        //
    }
    public function listerAllsoucription(User $user)
    {
        return $this->getPermission($user,6);
    }
    public function lister_les_mouvements_financiers(User $user)
    {
        return $this->getPermission($user,26);
    }
    public function listerprevalidablesouscription(User $user)
    {
        return $this->getPermission($user,5);
    }
     public function listervalidablesouscription(User $user){
        return $this->getPermission($user,7);
     }
     public function statuerSurSouscription(User $user){
        return $this->getPermission($user, 15);
     }
     public function listerSouscriptionsRetenues(User $user){
        return $this->getPermission($user, 16);
     }
     public function listerSouscriptionsParzone(User $user){
        return $this->getPermission($user, 17);
     }
     public function listerFormation(User $user){
        return $this->getPermission($user, 18);
     }
     public function listerTouteLesFormation(User $user){
        return $this->getPermission($user, 28);
     }
     public function modifierFormation(User $user){
        return $this->getPermission($user, 19);
     }
     public function geolocaliser(User $user){
        return $this->getPermission($user, 21);
     }
     public function tableauDebord(User $user){
        return $this->getPermission($user, 20);
     }
     public function tableauDebordUgp(User $user){
        return $this->getPermission($user, 55);
     }
     public function acceder_aux_decisions_sur_le_dossier(User $user){
        return $this->getPermission($user, 56);
     }
     public function avisqualitative_ugp(User $user){
        return $this->getPermission($user, 22);
     }
     public function avisfinal_ugp(User $user){
        return $this->getPermission($user, 23);
     }
     public function verdict_comite(User $user){
        return $this->getPermission($user, 24);
     }
     public function acceder_souscriptions(User $user){
        return $this->getPermission($user, 25);
     }
     public function donner_avis_membre_comite(User $user){
        return $this->getPermission($user, 27);
     }
 
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {

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
