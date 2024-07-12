<?php

use App\Models\Decision;
use App\Models\Proportion_de_depense_promotrice;
use App\Models\Infoeffectifentreprise;
use App\Models\User;
use App\Models\Valeur;
use App\Models\Indicateur;
use App\Models\Facture;
use App\Models\Entreprise;
use App\Models\Projet;
use App\Models\InvestissementProjet;
use App\Models\Infoentreprise;
use App\Models\Journal;
use App\Models\Promotrice;

use Illuminate\Support\Facades\Storage;

if (!function_exists('getlibelle')) {
    function getlibelle($id)
        {
            $record = Valeur::where('id', $id)->first();
            $libelle = isset($record['libelle']) ? $record['libelle'] : "";
                return $libelle;

        }
    }
    if (!function_exists('getrepresentationmembre')) {
        function getrepresentationmembre($id)
            {
                $record = User::where('id', $id)->first();
                $structure_represente = isset($record['structure_represente']) ? $record['structure_represente'] : "";
                return getlibelle($structure_represente) ;
            }
        }
        if (!function_exists('getnombrededecisiondesmembreducomitedelentreprise')) {
            function getnombrededecisiondesmembreducomitedelentreprise($id)
                {
                    $record = Decision::where('entreprise_id', $id)->get();
                    return count($record) ;
                }
            }
            if (!function_exists('reformater_montant')){
                function reformater_montant($montant){
                    return str_replace(",","",$montant);
                }

            }
            if (!function_exists('reformater_montant2')){
                function reformater_montant2($money){
                    $$money = str_replace('F CFA', '', strval($money));
                    $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
                    $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);
                    $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;
                    $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
                    $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '',  $stringWithCommaOrDot);
                    return (int) str_replace(',', '.', $removedThousandSeparator);
                }
            }
            if (!function_exists('getusername')) {
                function getusername($id)
                    {
                        $record = User::where('id', $id)->first();
                        $nom_utilisateur = isset($record['name']) ? $record['name']. ' '.$record['prenom'] : "";
                            return $nom_utilisateur;
                    }
                }
            if(!function_exists('monthletter')){
                function monthletter($num)
                    {
                        if($num==1){
                            $mois= 'Janvier';
                        }
                        if($num==2){
                            $mois= 'Fevrier';
                        }
                        if($num==3){
                            $mois= 'Mars';
                        }
                        if($num==4){
                            $mois= 'Avril';
                        }
                        if($num==5){
                            $mois= 'Mai';
                        }
                        if($num==6){
                            $mois= 'Juin';
                        }
                        if($num==7){
                            $mois= 'Juillet';
                        }
        
                        if($num==8){
                            $mois= 'Aout';
                        }
                        if($num==9){
                            $mois= 'Septembre';
                        } if($num==10){
                            $mois= 'Octobre';
                        }
                        if($num==11){
                            $mois= 'Novembre';
                        }
                        if($num==12){
                            $mois= 'Decembre';
                        }
                        
                            return $mois;
                    }
            }
            if (!function_exists('proportionpromoteur_enregistre')) {
                function proportionpromoteur_enregistre($id)
                    {
                        $record = Proportion_de_depense_promotrice::where('promotrice_id', $id)->get();
                        if(count($record)==0){
                            return 1;
                        }
                        else{
                            return 0;
                        }
                        
                    }
                    if(!function_exists('format_prix')){
                        function format_prix($prix){
                            return number_format($prix, 0, ' ',' ');
                        }
                    }
                    if(!function_exists('format_dollar_prix')){
                        function format_dollar_prix($prix){
                            return number_format($prix, 2, ',',' ');
                        }
                    }
                    if(!function_exists('format_date')){
                        function format_date($date){
                            return  date('d-m-Y', strtotime($date));
                        }
                    }
                    if(!function_exists('upload_file')){
                        function upload_file($url){
                            return Storage::download($url);
                        }
                    }
                     function telecharger($url)
                    { 
                        return $path = Storage::download($url);
                    }

                     if(!function_exists('return_sigle_bank')){
                        function return_sigle_bank($bank){
                        if($bank=='BANQUE ATLANTIQUE'){
                            return 'BABF';
                        }elseif($bank=='Coris bank'){
                           return 'CBI';
                        }
                        elseif($bank=='BOA'){
                            return 'BOA';
                        }
                        }
                    }

                    if(!function_exists('return_categorie_entreprise')){
                        function return_categorie_entreprise($categorie){
                        if($categorie=='aop'){
                            return 'AOP';
                        }elseif($categorie=='leader'){
                           return 'EL';
                        }
                        elseif($categorie=='mpme'){
                            return 'MPME';
                        }
                        }
                    }
                    if(!function_exists('return_status_facture')){
                        function return_status_facture($statut){
                        if($statut=='payée'){
                            return 'Payés';
                        }elseif($statut=='rejeté'){
                           return 'Rejetés';
                        }
                        elseif($statut=='validé'){
                            return 'Validés';
                        }
                        }
                    }

                    if(!function_exists('kyc_entreprise_is_valide')){
                        function kyc_entreprise_is_valide($code_promoteur){
                            $entreprise = Entreprise::where('code_promoteur',$code_promoteur)->where('decision_du_comite_phase1', 'selectionnee')->first();
                        if($entreprise->resultat_kyc= 'concluant' && $entreprise->date_de_creation_compte !=null){
                            return true;
                        }else{
                           return false;
                        }
                        }
                    }
                    if(!function_exists('getEntreprise')){
                        function getEntreprise($entreprise_id){
                            $entreprise = Entreprise::find($entreprise_id);
                            return $entreprise;
                        }
                    }
                    if(!function_exists('return_facture')){
                        function return_facture($id){
                            return Facture::find($id);
                        }
                    }
                    if(!function_exists('return_diffdate')){
                        function return_diffdate($date_debut, $date_fin){
                            $date1= strtotime($date_debut);
                           
                            $date2= strtotime($date_fin);
                            $datediff =  $date2 - $date1;
                           
                           // $diff= $date2->diff($date1)->format('%d');
                            return  round($datediff / (60 * 60 * 24));
                        }
                    }
                    if (!function_exists('Insertion_Journal'))
{
function Insertion_Journal($table,$operation)
    {
        $requete=Journal::create([
            'ip'=>gethostbyname(gethostname()),
            'user'=> Auth::user()->id.' '.Auth::user()->name.' '.Auth::user()->prenom,
            'operation' =>$operation,
            'nom_table'=> $table, 
        ]);
    }
}

                    if(!function_exists('taux_execution_budget')){
                        function taux_execution_budget($prevu, $depense){
                           $taux=  $depense/$prevu*100 ;
                          $taux= number_format($taux, 2, '.', '');
                            return $taux;
                        }
                    }
                    if(!function_exists('return_liste_entreprise_par_user')){
                        function return_liste_entreprise_par_user($user_id){
                            $user= User::find($user_id);
                            $entreprises= Entreprise::where('code_promoteur',$user->code_promoteur)->where('participer_a_la_formation',1)->get();
                            return $entreprises;
                            //dd($entreprises);
                        }
                       
                    }
                    if(!function_exists('return_info_enveloppe')){
                        function return_info_enveloppe(){
                           $total_enveloppe=  env('total_enveloppe_MPME') + env('total_enveloppe_AOP'); ;
                          $montant_accorde = InvestissementProjet::where('statut','validé')->sum('subvention_demandee_valide');
                          $subvention_accorde_aop= DB::table('entreprises')
                                    ->leftjoin('projets','projets.entreprise_id','=','entreprises.id')
                                    ->leftjoin('investissement_projets','investissement_projets.projet_id','=','projets.id')
                                    ->whereIn('entreprises.aopOuleader',['leader','AOP'])
                                    ->sum('investissement_projets.subvention_demandee_valide');
                        $subvention_accorde_mpme= DB::table('entreprises')
                                    ->leftjoin('projets','projets.entreprise_id','=','entreprises.id')
                                    ->leftjoin('investissement_projets','investissement_projets.projet_id','=','projets.id')
                                    ->where('entreprises.aopOuleader', 'MPME')
                                    ->sum('investissement_projets.subvention_demandee_valide');
                          $montant_restant= $total_enveloppe - $montant_accorde;
                          $infos= [$total_enveloppe,$montant_accorde,$montant_restant,$subvention_accorde_aop,$subvention_accorde_mpme];
                            return $infos;
                        }
                    }

                    if(!function_exists('arrondir_taux')){
                        function arrondir_taux($taux){
                          $taux= number_format($taux, 2, '.', '');
                          if($taux > 100)
                            return "100 % +" ;
                        else
                            return $taux." %";
                        }
                    }
                    if(!function_exists('generate_password')){
                        function generate_password($taille){
                            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $string = '';
                            for($i=0; $i<$taille; $i++){
                                $string .= $chars[rand(0, strlen($chars)-1)];
                            }
                            return $string;
                        }
                    }
                    if(!function_exists('nbre_beneficiaire_ayant_augmente_nbre_ind')){
                function nbre_beneficiaire_ayant_augmente_nbre_ind($indicateur){
                    $nbre_entreprise= DB::table('impacts')
                            ->join('entreprises',function($join){
                                $join->on('impacts.entreprise_id','=','entreprises.id');
                            })
                            ->where('impacts.indicateur_id',$indicateur)
                            ->where('impacts.valeur_creee','>',0)
                            ->get();
                            return count($nbre_entreprise);
                        }
                    }


                    // function permettant de formatter un nombre en deux chiffre
                    if(!function_exists('formater_deux_chiffres')){
                        function formater_deux_chiffres($nombre){
                          $taux= number_format($nombre, 2, '.', '');
                            return $taux;
                        }
                    }
                    if(!function_exists('return_quantite_indicateur')){
                        function return_quantite_indicateur($id_entreprise, $id_indicateur, $id_annee){
                           $info_entreprise= Infoentreprise::select(['quantite'])->where('entreprise_id', $id_entreprise)->where('indicateur',$id_indicateur)->where('annee', $id_annee)->first();
                           if($info_entreprise){
                            return $info_entreprise->quantite;
                           }
                           else{
                            return 0;
                           }
                            
                        }
                    }
                    if(!function_exists('return_effectif_homme')){
                        function return_effectif_homme($id_entreprise, $type_effectif, $id_annee){
                           $effectif_entreprise= Infoeffectifentreprise::select(['homme'])->where('entreprise_id', $id_entreprise)->where("effectif",$type_effectif)->where('annee', $id_annee)->first();
                            return $effectif_entreprise->homme;
                        }
                    }
                    if(!function_exists('return_effectif_femme')){
                        function return_effectif_femme($id_entreprise, $type_effectif, $id_annee){
                           $effectif_entreprise= Infoeffectifentreprise::select(['femme'])->where('entreprise_id', $id_entreprise)->where("effectif",$type_effectif)->where('annee', $id_annee)->first();
                            return $effectif_entreprise->femme;
                        }
                    }

                    if(!function_exists('return_proportion_depense')){
                        function return_proportion_depense($id_promotrice, $id_proportion, $id_annee){
                            
                            // $promotrice= DB::table('entreprises')
                            //                 ->leftjoin('promotrices','entreprises.promotrice_id','=','promotrices.id')
                            //                 ->select('promotrices.id as promotrice_id')
                            //                 ->get();
                           $proportition= Proportion_de_depense_promotrice::select(['pourcentage'])->where("promotrice_id",$id_promotrice)->where('proportion_id',$id_proportion)->where('annee_id', $id_annee)->first();
                           if($proportition){
                            return $proportition->pourcentage;
                           }
                           else{
                             return 0;
                           }
                           
                        }
                    }
                   
                    if(!function_exists('genererExcel')){
                        function genererExcel($items){
                            $fileName = "itemdata-".date('d-m-Y').".xls";

// Définir les informations d'en-tête pour exporter les données au format Excel

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$fileName);

// Défini la variable sur false pour l'en-tête
        $heading = false;

// Ajouter les données de la table MySQL au fichier Excel
        if(!empty($items)) {
    foreach($items as $item) {
    if(!$heading) {
    echo implode("\t", array_keys($item)) . "\n";
    $heading = true;
    }
    echo implode("\t", array_values($item)) . "\n";
    }
    }
    exit();
                            
                        }
                    }
                }
//fonction verifier le role 
if(!function_exists('return_role_adequat')){
    function return_role_adequat($id_role){
       $liste_roles= Auth::user()->roles;
        foreach($liste_roles as $role)
        {
            if($role->id==$id_role){
                return true;
            }
        }
            return false;

    }
}

//Fonctions utilisés sur l'interface impacts
if(!function_exists('return_taux_des_beneficiaire_ayant_evolue_sur_indicateur')){
    function return_taux_des_beneficiaire_ayant_evolue_sur_indicateur($code_indicateur){
       $indicateur= Indicateur::where('code_indicateur',$code_indicateur)->first()->id;

$beneficaire_evalues_sur_lindicateur= DB::table('impacts')
            ->leftjoin('entreprises',function($join){
                $join->on('impacts.entreprise_id','=','entreprises.id');
            })
            ->where('impacts.indicateur_id','=',$indicateur)
            ->select(DB::raw("count(distinct(entreprises.id)) as nombre"))
            ->count();
$nombre_de_beneficiaire_ayant_evolue= DB::table('impacts')
                                        ->leftjoin('entreprises',function($join){
                                            $join->on('impacts.entreprise_id','=','entreprises.id');
                                        })
                                        ->where('impacts.indicateur_id','=',$indicateur)
                                        ->where('impacts.valeur_creee','>',0)
                                        ->select(DB::raw("count(distinct(entreprises.id)) as nombre"))
                                        ->count(); 
        if($beneficaire_evalues_sur_lindicateur > 0){
            return $nombre_de_beneficiaire_ayant_evolue/$beneficaire_evalues_sur_lindicateur*100;
        }
        return 0;

    }
}
if(!function_exists('int2str')){              
    function int2str($a)
    {
    $convert = explode('.',$a);
    if (isset($convert[1]) && $convert[1]!=''){
    return int2str($convert[0]).'Dinars'.' et '.int2str($convert[1]).'Centimes' ;
    }
    if ($a<0) return 'moins '.int2str(-$a);
    if ($a<17){
    switch ($a){
    case 0: return '';
    case 1: return 'un';
    case 2: return 'deux';
    case 3: return 'trois';
    case 4: return 'quatre';
    case 5: return 'cinq';
    case 6: return 'six';
    case 7: return 'sept';
    case 8: return 'huit';
    case 9: return 'neuf';
    case 10: return 'dix';
    case 11: return 'onze';
    case 12: return 'douze';
    case 13: return 'treize';
    case 14: return 'quatorze';
    case 15: return 'quinze';
    case 16: return 'seize';
    }
    } else if ($a<20){
    return 'dix-'.int2str($a-10);
    } else if ($a<100){
    if ($a%10==0){
    switch ($a){
    case 20: return 'vingt';
    case 30: return 'trente';
    case 40: return 'quarante';
    case 50: return 'cinquante';
    case 60: return 'soixante';
    case 70: return 'soixante-dix';
    case 80: return 'quatre-vingt';
    case 90: return 'quatre-vingt-dix';
    }
    } elseif (substr($a, -1)==1){
    if( ((int)($a/10)*10)<70 ){
    return int2str((int)($a/10)*10).'-et-un';
    } elseif ($a==71) {
    return 'soixante-et-onze';
    } elseif ($a==81) {
    return 'quatre-vingt-un';
    } elseif ($a==91) {
    return 'quatre-vingt-onze';
    }
    } elseif ($a<70){
    return int2str($a-$a%10).'-'.int2str($a%10);
    } elseif ($a<80){
    return int2str(60).'-'.int2str($a%20);
    } else{
    return int2str(80).'-'.int2str($a%20);
    }
    } else if ($a==100){
    return 'cent';
    } else if ($a<200){
    return int2str(100).' '.int2str($a%100);
    } else if ($a<1000){
    return int2str((int)($a/100)).' '.int2str(100).' '.int2str($a%100);
    } else if ($a==1000){
    return 'mille';
    } else if ($a<2000){
    return int2str(1000).' '.int2str($a%1000).' ';
    } else if ($a<1000000){
    return int2str((int)($a/1000)).' '.int2str(1000).' '.int2str($a%1000);
    }
    else if ($a==1000000){
    return 'millions';
    }
    else if ($a<2000000){
    return int2str(1000000).' '.int2str($a%1000000).' ';
    }
    else if ($a<1000000000){
    return int2str((int)($a/1000000)).' '.int2str(1000000).' '.int2str($a%1000000);
    }
    else if ($a==1000000000){
    return 'milliard';
    }
    else if ($a<2000000000){
    return int2str(1000000).' '.int2str($a%1000000).' ';
    }
   
    }
}



?>
