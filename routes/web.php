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
use App\Http\Controllers\PromoteurController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\PreprojetController;
use App\Http\Controllers\CritereController;

use App\Http\Controllers\SouscriptionPEController;

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
    return view('index');
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
Route::post("/contact/message/", [SouscriptionPEController::class, "contactSendMessage"])->name("contact");
Route::get('page/souscription/PF/personne', [SouscriptionPEController::class,'create_personne'])->name('fp.create.personne');
Route::get('page/souscription/PE/personne', [SouscriptionPEController::class,'create_personne'])->name('pe.create.personne');

Route::get('page/souscription/PF/entreprise', [SouscriptionPEController::class,'create_entreprise'])->name('fp.create.entreprise');
Route::resource("promoteur", PromoteurController::class);
Route::resource("entreprise", EntrepriseController::class);
Route::post("souscription/manage/steps/fp",[EntrepriseController::class, 'creation'])->name("steps.manage.creation");
Route::post("souscription/manage/steps/pe",[EntrepriseController::class, 'creation_pe'])->name("steps.manage.creation_pe");

Route::post("page/souscription/PF/preprojet/creation",[PreprojetController::class, 'store_preprojet'])->name("preprojet.creation");
Route::post("page/souscription/PE/preprojet/creation",[PreprojetController::class, 'store_preprojet_pe'])->name("preprojet_pe.creation");
Route::get("recepisse/print/{promoteur}",[EntrepriseController::class,'genereRecpisse'])->name("generer.recepisse");
Route::get("store/second/entreprise/{promoteur}", [EntrepriseController::class, 'create2'])->name("secondEntreprise.store");
Route::post("/souscription/poursuivre/",[PromoteurController::class, 'search_promoteur'])->name("search.promoteur");
Route::get("/rechercher/promoteur/parcode_promoteur",[PromoteurController::class, 'search_promoteur_parcode_promoteur'])->name("promoteur.search");
Route::get("/souscription/control_doublon", [PromoteurController::class, 'control_doublon_souscription'])->name("souscription.control_doublon");
Route::resource("souscription",PreprojetController::class);
Route::get('afficher_details/preprojet/FP/{preprojet}', [PreprojetController::class, 'afficher_details_fp'])->name("preprojet.details");
Route::get('afficher_details/preprojet/PE/{preprojet}', [PreprojetController::class, 'afficher_details_pe'])->name("preprojet_pe.details");
Route::get("/lister/souscription/FP", [PreprojetController::class, 'lister_fp'])->name("preprojet.lister_fp");
Route::get("/lister/souscription/PE", [PreprojetController::class, 'lister_pe'])->name("preprojet.lister_pe");
Route::get('telechargerpiece/{piecejointe}', [PreprojetController::class,'telecharger'])->name('telechargerpiecejointe');
Route::get('detail/{piecejointe}', [PreprojetController::class,'detaildocument'])->name('detaildocument');
// Route::get("/lister/documents/utliles", [PreprojetController::class, 'lister_pe'])->name("preprojet.lister_pe");
Route::get('documents/telechargeables',[DocumentController::class, 'lister_docs_pubics'])->name('documents.public');
Route::get('telechargerdocument/{document}', [DocumentController::class,'telecharger'])->name('telechargerpiecejointe');

Route::get('/accueil', function () {
    return view('index');
})->name("accueil");
Route::get("/test", function () {
    return view('preprojet.show');
})->name("test");
Route::group([  
    "prefix" => "administration",
], function(){
    Route::resource('critere', CritereController::class);
    Route::get('modif/critere',[CritereController::class, 'modifier'] )->name('critere.modif');
    Route::post('/critaria/store_modif/critere',[CritereController::class, 'modifierstore'] )->name('critere.storemodif');
    Route::resource('users', UserController::class);
    Route::resource('documents', DocumentController::class);
    Route::get('critariat/modif/critere',[DocumentController::class, 'modifier'] )->name('document.modif');
    Route::post('store_modif/critere',[DocumentController::class, 'modifierstore'] )->name('document.storemodif');
    Route::resource('permissions', PermissionController::class);
    Route::resource("role",RoleController::class);
    Route::resource("parametres",ParametreController::class);
    Route::resource("valeurs", ValeurController::class);
    Route::get('/valeur', [ValeurController::class, 'selection'])->name("valeur.selection");
    Route::get("/reinitialise/password",[UserController::class, 'reinitialize'] )->name("user.reinitialize");
    Route::get('/listeval', [ValeurController::class,"listevakeur"])->name("valeur.listeval");
    Route::post('evaluation/preprojet', [PreprojetController::class,'evaluer'])->name('preprojet.evaluation');
    Route::post('modify/evaluation/preprojet', [PreprojetController::class,'evaluation_modify'])->name('preprojet.evaluation_modify');
    Route::post('modify/evaluation/preprojet_pe', [PreprojetController::class,'evaluation_modify_pe'])->name('preprojet.evaluation_modify_pe');

    Route::post('evaluation/preprojet_pe', [PreprojetController::class,'evaluer_pe'])->name('preprojet_pe.evaluation');
    Route::get('preprojet/save/eligibilite/fp',[PreprojetController::class,'save_eligibilite'])->name('preprojet.save_eligibilite');
    Route::get('preprojetpe/enregistre/eligibilite/pe',[PreprojetController::class,'save_eligibilite_pe'])->name('preprojet.save_eligibilite_pe');

    Route::get("/lister/preprojet/FP/traitement", [PreprojetController::class, 'lister_preprojet_fp_en_traitement'])->name("preprojet.traitement");
    Route::get("/lister/preprojet/FP/preselectionnes", [PreprojetController::class, 'lister_preprojet_fp_preselectionnes'])->name("preprojet.selected");
    Route::get("/erfdfg/preprojet/PE/preselectionnes", [PreprojetController::class, 'lister_preprojet_pe_preselectionnes'])->name("preprojet_pe.selected");

    Route::get("/lister/preprojet/PE/traitement", [PreprojetController::class, 'lister_preprojet_pe_en_traitement'])->name("preprojetpe.traitement");
    Route::get("/lister/preprojet/PE/preselectionnes", [PreprojetController::class, 'lister_preprojet_pe_preselectionnes'])->name("preprojetpe.selected");
    Route::get("/completer/preprojet/evaluation/", [PreprojetController::class, 'completer_evaluation_automatique'])->name("preprojetpe.completer_evaluation_automatique");


    Route::get('preprojet/valider/evaluation/fp',[PreprojetController::class,'valider_evaluation'])->name('preprojet.valider_evaluation');
    Route::get('preprojet/valider/evaluation/pe',[PreprojetController::class,'valider_evaluation_pe'])->name('preprojet.valider_evaluation_pe');
    Route::get('enre/avis/de/lequipe/preprojet/fp',[PreprojetController::class,'save_avis_de_lequipe'])->name('preprojet.save_avis_de_lequipe');
    Route::get('enre/avis/de/lequipe/preprojet/pe',[PreprojetController::class,'save_avis_de_lequipe_pe'])->name('preprojet.save_avis_de_lequipe_pe');
    Route::get('save/decision/du/comite/preprojet/fp',[PreprojetController::class,'save_avis_decision_du_comite'])->name('preprojet.save_decision_du_comite');
    Route::get('save/decision/du/comite/preprojet/pe',[PreprojetController::class,'save_avis_decision_du_comite_pe'])->name('preprojet.save_decision_du_comite_pe');
    Route::get('soumis/au/comite/preprojet/fp',[PreprojetController::class,'lister_preprojet_soumis_au_comite_fp'])->name('preprojet.soumis_au_comite_fp');
    Route::get('soumis/au/comite/preprojet/pe',[PreprojetController::class,'lister_preprojet_soumis_au_comite_pe'])->name('preprojet.soumis_au_comite_pe');

    Route::get('/dashboard/programme/entreprendre',[DashboardController::class,'dashboard_pe'])->name('dashboard.pe');
    Route::get('/dashboard/fonds/partenariat',[DashboardController::class,'dashboard_fp'])->name('dashboard.fp');
    Route::get('/etat/preprojet/par_region', [DashboardController::class, 'avant_projet_par_region'])->name('preprojet.par_region');
    Route::get('/preprojet/par_region/par_sexe', [DashboardController::class,'avant_projet_soumis_par_region_et_par_sexe'])->name('preprojet.par_region_et_par_sexe');
    Route::get('/preprojet/par_secteur_dactivite', [DashboardController::class,'avant_projet_par_secteur_dactivite'])->name('preprojet.par_secteur_dactivite');
    Route::get('/etat/preprojetpe/par_region', [DashboardControllerPE::class, 'avant_projet_par_region_pe'])->name('preprojetpe.par_region');
    Route::get('/preprojetpe/par_region/par_sexe', [DashboardControllerPE::class,'avant_projet_soumis_par_region_et_par_sexe_pe'])->name('preprojetpe.par_region_et_par_sexe');
    Route::get('/preprojetpe/par_secteur_dactivite', [DashboardControllerPE::class,'avant_projet_par_secteur_dactivite_pe'])->name('preprojetpe.par_secteur_dactivite');
    Route::get('/preprojet/selectionne/par_region/par_sexe', [DashboardController::class,'avant_projet_selectionne_par_region_et_par_sexe'])->name('preprojet.selected.par_region_et_par_sexe');
    Route::get('/preprojet/selectionne/generer/doc_synthese_comite/{preprojet}', [PreprojetController::class,'generer_doc_synthese_comite'])->name('preprojet.generer_doc_synthese_comite');
    
});
