<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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
Route::post("/contact/message/", [SouscriptionPEController::class, "contactSendMessage"])->name("contact");
Route::get('page/souscription/PF/personne', [SouscriptionPEController::class,'create_personne'])->name('fp.create.personne');
Route::get('page/souscription/PE/personne', [SouscriptionPEController::class,'create_personne'])->name('pe.create.personne');

Route::get('page/souscription/PF/entreprise', [SouscriptionPEController::class,'create_entreprise'])->name('fp.create.entreprise');
Route::resource("promoteur", PromoteurController::class);
Route::resource("entreprise", EntrepriseController::class);
Route::post("creation",[EntrepriseController::class, 'creation'])->name("entreprise.creation");
Route::post("page/souscription/PF/preprojet/creation",[PreprojetController::class, 'store_preprojet'])->name("preprojet.creation");
Route::get("recepisse/print/{promoteur}",[EntrepriseController::class,'genereRecpisse'])->name("generer.recepisse");
Route::get("store/second/entreprise/{promoteur}", [EntrepriseController::class, 'create2'])->name("secondEntreprise.store");
Route::post("/souscription/poursuivre/",[PromoteurController::class, 'searchfp'])->name("fp.search");
Route::get("/rechercher/promoteur/parcode_promoteur",[PromoteurController::class, 'search_promoteur_parcode_promoteur'])->name("promoteur.search");
Route::get("/souscription/control_doublon", [PromoteurController::class, 'control_doublon_souscription'])->name("souscription.control_doublon");
Route::resource("souscription",PreprojetController::class);
Route::get("/lister/souscription", [PreprojetController::class, 'lister'])->name("preprojet.lister");
Route::get('telechargerpiece/{piecejointe}', [PreprojetController::class,'telecharger'])->name('telechargerpiecejointe');
Route::get('detail/{piecejointe}', [PreprojetController::class,'detaildocument'])->name('detaildocument');
Route::post('evaluation/preprojet', [PreprojetController::class,'evaluer'])->name('preprojet.evaluation');

Route::resource('critere', CritereController::class);
Route::get('modif/critere',[CritereController::class, 'modifier'] )->name('critere.modif');
Route::post('store_modif/critere',[CritereController::class, 'modifierstore'] )->name('critere.storemodif');
Route::get('/accueil', function () {
    return view('index');
})->name("accueil");
Route::get("/test", function () {
    return view('preprojet.show');
})->name("test");
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
    
});
