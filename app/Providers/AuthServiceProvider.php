<?php

namespace App\Providers;
use App\Policies\ParametrePolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\ProjetPolicy;
use App\Policies\ValeurPolicy;
use App\Policies\SouscriptionPolicy;
use App\Policies\PlaintePolicy;
use App\Policies\DashboardPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::resource('role', RolePolicy::class);
        Gate::resource('parametre', ParametrePolicy::class);
        Gate::resource('valeur', ValeurPolicy::class);
        Gate::resource('user', UserPolicy::class);
        Gate::define('lister_souscription_pe',[SouscriptionPolicy::class,'lister_souscription_pe'] );
        Gate::define('lister_souscription_fp',[SouscriptionPolicy::class,'lister_souscription_fp'] );
        Gate::define('evaluer_souscription',[SouscriptionPolicy::class,'evaluer_souscription'] );
        Gate::define('gerer_user',[UserPolicy::class,'gerer_user'] );
        Gate::define('gerer_critere',[UserPolicy::class,'gerer_critere'] );
        Gate::define('gerer_parametrage',[ParametrePolicy::class,'gerer_parametrage'] );
        Gate::define('lister_avant_projet_a_evaluer_fp',[SouscriptionPolicy::class,'lister_avant_projet_a_evaluer_fp']);
        Gate::define('lister_avant_projet_evalues_fp',[SouscriptionPolicy::class,'lister_avant_projet_evalues_fp']);
        Gate::define('lister_avant_projet_soumis_au_comite_fp',[SouscriptionPolicy::class,'lister_avant_projet_soumis_au_comite_fp']);
        Gate::define('lister_avant_projet_selectionnes_fp',[SouscriptionPolicy::class,'lister_avant_projet_selectionnes_fp']);
        Gate::define('donner_lavis_de_lequipe_fp',[SouscriptionPolicy::class,'donner_lavis_de_lequipe_fp']);
        Gate::define('donner_lavis_de_lequipe_pe',[SouscriptionPolicy::class,'donner_lavis_de_lequipe_pe']);

        Gate::define('valider_levaluation_de_lavant_projet_fp',[SouscriptionPolicy::class,'valider_levaluation_de_lavant_projet_fp']);
        Gate::define('valider_levaluation_de_lavant_projet_pe',[SouscriptionPolicy::class,'valider_levaluation_de_lavant_projet_pe']);
        Gate::define('lister_avant_projet_soumis_au_comite_pe',[SouscriptionPolicy::class,'lister_avant_projet_soumis_au_comite_pe']);
        Gate::define('valider_la_decision_du_comite',[SouscriptionPolicy::class,'valider_la_decision_du_comite']);
        Gate::define('valider_la_decision_du_comite_pe',[SouscriptionPolicy::class,'valider_la_decision_du_comite_pe']);

        Gate::define('lister_avant_projet_a_evaluer_pe',[SouscriptionPolicy::class,'lister_avant_projet_a_evaluer_pe']);
        Gate::define('lister_avant_projet_evalues_pe',[SouscriptionPolicy::class,'lister_avant_projet_evalues_pe']);
        Gate::define('valider_leligibilite_fp',[SouscriptionPolicy::class,'valider_leligibilite_fp']);
        Gate::define('valider_leligibilite_pe',[SouscriptionPolicy::class,'valider_leligibilite_pe']);
        Gate::define('lister_avant_projet_ineligible',[SouscriptionPolicy::class,'lister_avant_projet_ineligible']);
        Gate::define('lister_avant_projet_ineligible_pe',[SouscriptionPolicy::class,'lister_avant_projet_ineligible_pe']);
        Gate::define('lister_avant_projet_selectionne_pe',[SouscriptionPolicy::class,'lister_avant_projet_selectionne_pe']);
        Gate::define('acceder_au_dashboard_du_fp',[DashboardPolicy::class,'acceder_au_dashboard_du_fp']);
        Gate::define('acceder_au_dashboard_du_pe',[DashboardPolicy::class,'acceder_au_dashboard_du_pe']);
        Gate::define('visualiser_historique_de_traitement',[SouscriptionPolicy::class,'visualiser_historique_de_traitement']);

        Gate::define('lister_les_projets_soumis',[ProjetPolicy::class,'lister_les_projets_soumis']);
        Gate::define('lister_projet_aanalyse_chef_dantenne',[ProjetPolicy::class,'lister_projet_aanalyse_chef_dantenne']);
        Gate::define('lister_projet_analyse_par_chef_dantenne',[ProjetPolicy::class,'lister_projet_analyse_par_chef_dantenne']);
        Gate::define('lister_projet_soumis_au_comite',[ProjetPolicy::class,'lister_projet_soumis_au_comite']);
        Gate::define('lister_decision_comite_projet',[ProjetPolicy::class,'lister_decision_comite_projet']);
        Gate::define('verdict_du_comite_plan_daffaire',[ProjetPolicy::class,'verdict_du_comite_plan_daffaire']);

        Gate::define('lister_les_plaintes',[PlaintePolicy::class,'lister']);
        Gate::define('visualiser_une_plainte',[PlaintePolicy::class,'visuliser']);
        Gate::define('changer_statut_plainte',[PlaintePolicy::class,'changer_statut']);
        Gate::define('lister_en_attente_du_ses',[ProjetPolicy::class,'lister_en_attente_du_ses']);
        Gate::define('donner_lavis_du_ses',[ProjetPolicy::class,'donner_lavis_du_ses']);
    }
}
