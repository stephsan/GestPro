<?php

namespace App\Providers;
use App\Policies\ParametrePolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\ValeurPolicy;
use App\Policies\SouscriptionPolicy;



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
        
       

        

        //
    }
}
