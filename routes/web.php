<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardControllerPE;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ValeurController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\ComposanteController;
use App\Http\Controllers\ActiviteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard.fp');
})->name('index');

Route::get('/inscrire', function () {
    return view('inscrire');
})->name('inscrire');
Route::get('/projet', function () {
    return view('projet');
})->name('projet');
Route::get('/form', function () {
    return view('form');
})->name('form');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
});

Route::get('/register',[UserController::class,'register']);

// Route::get("/lister/documents/utliles", [PreprojetController::class, 'lister_pe'])->name("preprojet.lister_pe");
Route::get('documents/telechargeables',[DocumentController::class, 'lister_docs_pubics'])->name('documents.public');
Route::get('telechargerdocument/{document}', [DocumentController::class,'telecharger'])->name('telechargerdocs');
Route::post('/store/beneficiary/compte', [UserController::class,'storecomptePromoteur'])->name('beneficiary_compte.store');

Route::get('/projet/modif',[ProjetController::class, 'pca_modif'])->name('pca.modif');
Route::post('/projet/modifier',[ProjetController::class, 'pca_modifier'])->name('pca.modifier');
Route::get('/piecejointe/modif',[ProjetController::class, 'modif_piecej'])->name('piece.modif');
Route::post('/piecejointe/modifier',[ProjetController::class, 'modifier_piecej'])->name('piecejointe.modifier');


route::get("/verifier_promoteur/compte/",[UserController::class,'verifier_conformite_cpt'])->name('verifier_validite_cpt_promo');
 Route::get('beneficiary/project/{document}', [DocumentController::class,'telecharger'])->name('telechargerdocument');
// Route::get('telechargerpiece/{piecejointe}', [PreprojetController::class,'telecharger'])->name('telechargerpiecejointe');

Route::group([  
    "prefix" => "administration",
], function(){
    
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource("role",RoleController::class);
    Route::resource("parametres",ParametreController::class);
    Route::resource("valeurs", ValeurController::class);
    Route::get('/valeur', [ValeurController::class, 'selection'])->name("valeur.selection");
    Route::get("/reinitialise/password",[UserController::class, 'reinitialize'] )->name("user.reinitialize");
    Route::get('/listeval', [ValeurController::class,"listevakeur"])->name("valeur.listeval");

    Route::get('/dashboard/fonds/partenariat',[DashboardController::class,'dashboard'])->name('dashboard.fp');
    Route::get('/etat/preprojetpe/par_region', [DashboardControllerPE::class, 'avant_projet_par_region_pe'])->name('preprojetpe.par_region');
//Tableau de bord dynamique plans d'affaire
    Route::get('/projet/par_region', [DashboardController::class, 'pa_par_region'])->name('projet.par_region');
    Route::get('/projet/par_region/par_sexe', [DashboardController::class,'pa_soumis_par_region_et_par_sexe'])->name('projet.par_region_et_par_sexe');
    Route::get('/projet/par_secteur_dactivite', [DashboardController::class,'pa_par_secteur_dactivite'])->name('projet.par_secteur_dactivite');
    Route::get('/projet/par/guichet', [DashboardController::class,'pa_par_guichet'])->name('projet.reparti_par_guichet');


    Route::get('/preprojetpe/par_region/par_sexe', [DashboardControllerPE::class,'avant_projet_soumis_par_region_et_par_sexe_pe'])->name('preprojetpe.par_region_et_par_sexe');
    Route::get('/preprojetpe/par_secteur_dactivite', [DashboardControllerPE::class,'avant_projet_par_secteur_dactivite_pe'])->name('preprojetpe.par_secteur_dactivite');
    Route::get('/preprojet/selectionne/par_region/par_sexe', [DashboardController::class,'avant_projet_selectionne_par_region_et_par_sexe'])->name('preprojet.selected.par_region_et_par_sexe');
    Route::get('/preprojet/selectionne/generer/doc_synthese_comite/{preprojet}', [PreprojetController::class,'generer_doc_synthese_comite'])->name('preprojet.generer_doc_synthese_comite');
    Route::get('/preprojet/par_guichet/par_region', [DashboardController::class,'avant_projet_par_guichet_par_region'])->name('preprojet.par_guichet_par_region');
    Route::get('/preprojet/par_guichet', [DashboardController::class,'avant_projet_par_guichet'])->name('preprojet.par_guichet');
    Route::get('/preprojet/par_guichet', [DashboardController::class,'avant_projet_par_guichet'])->name('preprojet.par_guichet');
    Route::get("/dashboard/preprojetpe/geopresentation", [DashboardController::class, 'avant_projet_pe_geopresenation'])->name("pe.avant_projet_geopresenation");
    Route::resource('coach', CoachController::class);
    Route::get('/scoach/modif/', [CoachController::class, 'modif'])->name('coach.modif');
    Route::post('/coach/save/modif/', [CoachController::class, 'enremodif'])->name('coach.enremodif');
    Route::post("simple-excel/import",  [PreprojetController::class, "chargerEvaluation"])->name('excel.chargerEvaluation');
    Route::post("PA/simple-excel/import",  [ProjetController::class, "chargerEvaluation"])->name('excel.chargerEvaluation_Plan_daffaire');
    Route::post("evaluationPe/import",  [PreprojetController::class, "chargerEvaluationPe"])->name('excel.chargerEvaluationPe');
    Route::get('/preprojet/evaluation/automatiques', [DashboardController::class,'avant_projet_par_guichet'])->name('preprojet.par_guichet');
    Route::post('pa_eval/store',[ProjetController::class, 'storeaval'] )->name('pca.evaluation');
    Route::get('/pa/analyse/{projet}',[ProjetController::class, 'analyser'])->name('pca.analyse');
    Route::get('/pa/valider/analyse', [ProjetController::class, 'valider_analyse'])->name('pca.valider_analyse');
    Route::get('/pa/avis_chefdentenne', [ProjetController::class, 'pca_save_avis_chefdantenne'])->name('pca.save_avis_chefdantenne');
    Route::get('/pa/avis_equipe_fp', [ProjetController::class, 'pca_save_avis_equipe_fp'])->name('pca.save_avis_equipe_fp');
    Route::get('/pa/rejeter_lanalyse_du_pa', [ProjetController::class, 'rejeter_lanalyse_pa'])->name('pca.rejeter_lanalyse_pa');
    Route::post('/valider/ligne_investissement/',[ProjetController::class,'valider_investissement'])->name('investissement.valide');
    Route::post('/rejetter/investissements', [ProjetController::class, 'rejetter_investissement'])->name('rejeter.investissement');
    Route::get('/pa/save/decision_du_comite', [ProjetController::class, 'savedecisioncomite'])->name('plan_daffaire.save_decision_du_comite');
    Route::post('/completer/projet/file_eval',[ProjetController::class,'completer_dossier'])->name('projet.complete_file');

    Route::get('projetsss/lister/',[ProjetController::class,'lister'])->name('projet.lister');
    Route::get('modif/composante',[ComposanteController::class,'modif'])->name('composante.modif');
    Route::resource('projet',ProjetController::class);
    Route::resource('composante',ComposanteController::class);
    Route::resource('activite',ActiviteController::class);
    Route::post('importer/realisation',[ProjetController::class,'importer_realisation'])->name('realisation.import');
    Route::get('/dashboard/details',[DashboardController::class,'dashboard'])->name('dashboard.detail');
    Route::get('pre/projet/composante', [DashboardController::class,'taux_par_composante'])->name('projet.taux_par_composante');
    Route::get('situation/par_categorie', [DashboardController::class,'taux_par_categorie_dactivite'])->name('preprojet.par_region');
    Route::get('taux/statut/activite', [DashboardController::class,'taux_par_statut_activite'])->name('preprojet.par_secteur_dactivite');
    Route::get('get/taux/projet', [DashboardController::class,'getTaux'])->name('projet.getTaux');
    Route::get('get/taux/par/categorie_projet', [DashboardController::class,'taux_par_categorie'])->name('projet.taux_par_categorie');
    Route::get('situation/par/satut/activite', [DashboardController::class,'repartition_par_satut_activite'])->name('activite.repartition_par_statut');

    
    

});
