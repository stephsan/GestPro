<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
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
Route::post('evaluation/preprojet', [PreprojetController::class,'evaluer'])->name('preprojet.evaluation');
Route::post('evaluation/preprojet_pe', [PreprojetController::class,'evaluer_pe'])->name('preprojet_pe.evaluation');
// Route::get("/lister/documents/utliles", [PreprojetController::class, 'lister_pe'])->name("preprojet.lister_pe");
Route::get('documents/telechargeables',[DocumentController::class, 'lister_docs_pubics'])->name('documents.public');
Route::get('telechargerdocument/{document}', [DocumentController::class,'telecharger'])->name('telechargerpiecejointe');

Route::get("/lister/preprojet/FP/traitement", [PreprojetController::class, 'lister_preprojet_fp_en_traitement'])->name("preprojet.traitement");
Route::get("/lister/preprojet/FP/preselectionnes", [PreprojetController::class, 'lister_preprojet_fp_preselectionnes'])->name("preprojet.selected");




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
    Route::post('store_modif/critere',[CritereController::class, 'modifierstore'] )->name('critere.storemodif');
    Route::resource('users', UserController::class);
    Route::resource('documents', DocumentController::class);
    Route::get('modif/critere',[DocumentController::class, 'modifier'] )->name('document.modif');
Route::post('store_modif/critere',[DocumentController::class, 'modifierstore'] )->name('document.storemodif');
    Route::resource('permissions', PermissionController::class);
    Route::resource("role",RoleController::class);
    Route::resource("parametres",ParametreController::class);
    Route::resource("valeurs", ValeurController::class);
    Route::get('/valeur', [ValeurController::class, 'selection'])->name("valeur.selection");
    Route::get("/reinitialise/password",[UserController::class, 'reinitialize'] )->name("user.reinitialize");
    Route::get('/listeval', [ValeurController::class,"listevakeur"])->name("valeur.listeval");
    
});
