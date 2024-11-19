<?php

namespace App\Http\Controllers;
use App\Models\Promoteur;
use App\Models\Preprojet;
use App\Models\Piecejointe;
use App\Models\Entreprise;
use App\Models\PreprojetParametre;
use App\Models\Infoentreprise;
use App\Models\Valeur;
use App\Models\Infoeffectifentreprise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BeneficiaireController extends Controller
{
    function get_my_data(){
       
        $promoteur=Promoteur::where('code_promoteur',Auth::user()->login)->first();
        $preprojet=Preprojet::where('promoteur_id', $promoteur->id)->where('decision_du_comite','favorable')->first();
        $entreprise=Entreprise::where('id',$preprojet->entreprise_id)->first();
        $piecejointes=Piecejointe::Where("preprojet_fp_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
        $chiffre_daffaires=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $chiffre_daffaires=Infoentreprise::where('entreprise_id',$entreprise->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE'))->get();
        $effectif_permanent= Infoeffectifentreprise::where('entreprise_id',$entreprise->id)->where("effectif",env("VALEUR_EFFECTIF_PERMANENENT"))->get();
        $effectif_temporaire= Infoeffectifentreprise::where('entreprise_id',$entreprise->id)->where("effectif",env("VALEUR_EFFECTIF_TEMPORAIRE"))->get();
        $nombre_de_client_envisages=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $projet_innovations= PreprojetParametre::where("parametre_id",44)->where("preprojet_fp_id",$preprojet->id)->get();
        //dd($projet_innovations);
        $sources_dapprovisionnements= PreprojetParametre::where("parametre_id",12)->where("preprojet_fp_id",$preprojet->id)->get();
        return view('beneficaire.accueil',compact('piecejointes','projet_innovations','sources_dapprovisionnements','nombre_de_client_envisages','effectif_temporaire','effectif_permanent','chiffre_daffaires','promoteur','preprojet'));
    }
}
