<?php

namespace App\Http\Controllers;

use App\Models\Promoteur;
use App\Models\Valeur;
use App\Models\Piecejointe;
use App\Models\Entreprise;
use App\Jobs\SendEmailJob;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PromoteurController extends Controller
{
    public function control_doublon_souscription(Request $request){
      
        //dd($request->mobile_promoteur);
     if($request->mobile_promoteur){
        $promoteur= Promoteur::where("numero_identite", $request->numero_identite)
        ->orWhere("telephone_promoteur", $request->telephone_promoteur)
        ->orWhere("mobile_promoteur", $request->mobile_promoteur)
        ->orWhere("email_promoteur", $request->email_promoteur)
        ->first();
        return json_encode($promoteur);
     }
     
     else{
        $promoteur= Promoteur::where("numero_identite", $request->numero_identite)
        ->orWhere("telephone_promoteur", $request->telephone_promoteur)
        ->orWhere("telephone_promoteur", $request->mobile_promoteur)
        ->orWhere("email_promoteur", $request->email_promoteur)
        ->first();
        return json_encode($promoteur);
     }
        
           
           
           
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return redirect()->back();
        $regions=Valeur::where('parametre_id',env('PARAMETRE_ID_REGION'))->get();
        $niveau_instructions=Valeur::where("parametre_id", env('PARAMETRE_NIVEAU_D_INSTRUCTION'))->get();
        $nb_annee_experience=Valeur::where("parametre_id", env('PARAMETRE_TRANCHE_EXPERIENCE'))->get();
        $proportiondedepences= Valeur::where('parametre_id', 31)->get();
        $type_handicaps= Valeur::where('parametre_id', 48)->get();
        $occupation_professionnelle_actuelles =Valeur::where("parametre_id",env('PARAMETRE_OCCUPATION_PROFESSIONNELLE'))->get();
        $annees=Valeur::where('parametre_id',16 )->where('id','!=', 46)->get();
        return view("public.subscription", compact('occupation_professionnelle_actuelles','type_handicaps',"regions", "niveau_instructions","nb_annee_experience","proportiondedepences","annees"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return redirect()->back();
        $type_entreprise= $request->type_entreprise;
        $programme= $request->programme;
        // dd( $type_entreprise.''.$programme);
        $annees=Valeur::where('parametre_id',16 )->where('id','!=', 46)->get();
        $this->email = $request->email_promoteur;
        $this->nom = $request->nom_promoteur;
        $this->prenom= $request->prenom_promoteur;
       $validated= $request->validate([
            'nom_promoteur' =>'required',
            'numero_identite'=>'unique:promoteurs|max:255',
            'mobile_promoteur'=>'unique:promoteurs|max:255',
            'telephone_promoteur'=>'unique:promoteurs|max:255',
            ]);
        $dateTime = new \DateTime();
        $dateTime= $dateTime->format('His');
        $lastOne = DB::table('promoteurs')->latest('id')->first();
        if($lastOne){
            $code_promoteur = 'EC-'.$lastOne->id.$dateTime;
       
        }
        else{
            $code_promoteur = 'EC-'.'0'.$dateTime;
        }
        $details['email'] = $this->email;
        $details['nom'] = $this->nom;
        $details['prenom'] = $this->prenom;
        $details['code'] = $code_promoteur;
        if($request->numero_identite_passport==null){
            $numero_identite=$request->numero_identite_cnib;
        }else{
            $numero_identite=$request->numero_identite_passport;
        }
        //dd($numero_identite);
        
        $datenaiss= date('Y-m-d', strtotime($request->datenais_promoteur));
        $date_etabli_identite= date('Y-m-d', strtotime($request->date_identification));
       $promoteur= Promoteur::create([
            'nom' => $request->nom_promoteur,
            'prenom' => $request->prenom_promoteur,
            'datenais' => $datenaiss,
            'genre' => $request->genre,
            'avec_handicape' => $request->handicape,
            'type_handicap' => $request->type_handicap,
            'telephone_promoteur' => $request->telephone_promoteur,
            'email_promoteur' => $request->email_promoteur,
            'type_identite' => $request->type_identite_promoteur,
            'numero_identite' => $numero_identite,
            'date_etabli_identite' => $date_etabli_identite,
            'mobile_promoteur' => $request->mobile_promoteur,
            'code_promoteur'=>$code_promoteur,
            'region_residence' => $request->region_residence,
            'province_residence' => $request->province_residence,
            'commune_residence' => $request->commune_residence,
            'situation_residence' => $request->situation_residence,
            'arrondissement_residence' => $request->arrondissement_residence,
            'niveau_instruction' => $request->niveau_instruction,
            'autre_niveau_dinstruction' => $request->autre_niveau_instruction,
            'numero_du_proche'=> $request->numero_du_proche,
            'domaine_formation'=> $request->domaine_formation,
            //'nombre_annee_experience'=> $request->nombre_annee_experience,
            'precision_residence' => $request->precision_residence,
            'formation_en_rapport_avec_activite' => $request->formation_activite,
            'occupation_professionnelle_actuelle' => $request->occupation_pro_actuelle,
            'membre_ass' => $request->membre_ass,
            'occupation_professionnelle_actuelle'=>$request->situation_professionnelle,
            // 'compte_perso_existe' => $request->compte_perso_existe,
            // 'structure_financiere_personne'=> $request->structure_financiere_personne,
            'associations' => $request->associations,
            'suscription_etape'=>1,
            'suscription_etape_pe'=>1
        ]);
        if ($request->hasFile('docidentite')) {
            $file = $request->file('docidentite');
            $extension=$file->getClientOriginalExtension();
            $fileName = $promoteur->code_promoteur.'.'.$extension;
            $emplacement='public/docidentification'; 
            $urldocidentite= $request['docidentite']->storeAs($emplacement, $fileName);
            Piecejointe::create([
                'type_piece'=>env("VALEUR_ID_DOCUMENT_IDENTITE"),
                  'promoteur_id'=>$promoteur->id,
                  'url'=>$urldocidentite,
              ]);
        }
      
        $dest=dispatch(new SendEmailJob($details));
        if($programme=='FP'){
             return  view("fond_partenariat.validateStep1", compact('programme',"type_entreprise","promoteur"))->with('success','Item created successfully!');
        }
        else{
            return  view("programme_entreprendre.validateStep1", compact('programme',"type_entreprise","promoteur"))->with('success','Item created successfully!');

        }
    }

    public function afficherform(){
        return view("public.search");
    }
    public function afficherform_mpme(){
        return view("public.searchmpme");
    }
    public function result(Request $request){
        $promoteur = Promoteur::where("code_promoteur", $request->code_promoteur)->first();
        if($promoteur==null){
            $result= 'code promoteur invalide';
        }
        else{
           // dd($promoteur);
           $entreprises= Entreprise::where('promoteur_id', $promoteur->id)->get();
            //dd($entreprises);
           $data=[];
            foreach( $entreprises as $value)
            {
                if($value->decision_du_comite_phase1==null){
                    $resultat= "resultat non disponible";
                }
                else{
                    $resultat =$value->decision_du_comite_phase1;
                }
               $data[] = array('denomination'=>$value->denomination, 'resultat'=>$resultat);
            }
            return json_encode($data);

        }
        $data=[];
        $data= array('result'=>$result);
        return json_encode($data);
    }
    public function entrepriseRetenuParPromoteur(Request $request){
        $promoteur = Promoteur::where("code_promoteur", $request->code_promoteur)->first();
        if($promoteur==null){
            $result= 'code promoteur invalide';
        }
        else{
          
           $entreprises= Entreprise::where('promoteur_id', $promoteur->id)->where('decision_du_comite_phase1', "selectionnee")->where('participer_a_la_formation',1)->get();
           $data=[];
            foreach( $entreprises as $value)
            {
               $data[] = array('id_entreprise'=>$value->id,'denomination'=>$value->denomination);
            }
            return json_encode($data);

        }
        $data=[];
        $data= array('result'=>$result);
        return json_encode($data);
    } 

    public function search(Request $request)
    {
        $promoteur = Promoteur::where("code_promoteur", $request->code_promoteur)->first();
            if($promoteur==null){
                return view("invalide", compact("promoteur"));
            }
        else{
            $entreprise_traite= Entreprise::where('code_promoteur', $promoteur->code_promoteur)->where("aopOuleader","aop")->where("conforme","!=",null)->get();
            $entreprise_nn_traite= Entreprise::where('code_promoteur', $promoteur->code_promoteur)->whereIn("aopOuleader",["aop","leader"])->where("conforme",null)->get();
            $nbre_ent_nn_traite = count($entreprise_nn_traite);
            if(!$entreprise_traite){
            if($promoteur->suscriptionaopleader_etape==2){
                $entreprise= Entreprise::where("promoteur_id",$promoteur->id )->first();
                $entreprise=$entreprise->id;
                return view("validateStep1", compact("promoteur","entreprise"));
            }
            elseif($promoteur->suscriptionaopleader_etape==1 || $promoteur->suscriptionaopleader_etape==null ){
                return view("validateStep1aop", compact("promoteur","nbre_ent_nn_traite"));
            }
            else{
                return view("validateStep1aop", compact("promoteur","nbre_ent_nn_traite"));
            }
        }
        else{
            // Verifions si une de ses entreprise à un PCA
            $projet=  DB::table('entreprises')
                        ->join('projets','projets.entreprise_id','entreprises.id')
                        ->whereIn('entreprises.aopOuleader',["aop","leader"])
                        ->where('entreprises.code_promoteur', $promoteur->code_promoteur)
                        ->first();
                       
            if($projet){
                return view("invalide", compact("promoteur"));
            }
            else{
                if($promoteur->suscriptionaopleader_etape==2){
                    $entreprise= Entreprise::where("promoteur_id",$promoteur->id )->first();
                    $entreprise=$entreprise->id;
                    return view("validateStep1aop", compact("promoteur","entreprise","nbre_ent_nn_traite"));
                }
                elseif($promoteur->suscriptionaopleader_etape==1 || $promoteur->suscriptionaopleader_etape==null ){
                    return view("validateStep1aop", compact("promoteur","nbre_ent_nn_traite"));
                }
                return view("validateStep1aop", compact("promoteur", "nbre_ent_nn_traite"));
            }
        }

    }
    }
    public function search_promoteur(Request $request){
        $promoteur = Promoteur::where("code_promoteur", $request->code_promoteur)->first();
        $type_entreprise = $request->type_FP;
        $programme = $request->programme;
        //dd($type_entreprise);
       // dd($type_entreprise);
        if($promoteur==null){
            
        }
        else{
        $entreprise_traite= Entreprise::where('code_promoteur', $promoteur->code_promoteur)->get();
        $entreprise_nn_traite= Entreprise::where('code_promoteur', $promoteur->code_promoteur)->get();
        //nombre de nouvelle entreprise enregistré pas le promoteur
        $nbre_ent_nn_traite = count($entreprise_nn_traite);
       
        // Verifions s'il y'a une entreprise en son nom lors de la phase une
        // S'il n'ya pas d'entreprise traitée
        // if(!$entreprise_traite){
        if($programme=='FP'){
            if($promoteur->suscription_etape==2){
                $entreprise= Entreprise::where("promoteur_id",$promoteur->id)->first();
                $entreprise=$entreprise->id;
                return view("fond_partenariat.validateStep1", compact('programme','type_entreprise',"promoteur","entreprise",'nbre_ent_nn_traite'));
            }
                elseif($promoteur->suscription_etape==1 || $promoteur->suscription_etape==null ){
                return view("fond_partenariat.validateStep1", compact('programme','type_entreprise',"promoteur"));
            }
            else{
               
                return view("fond_partenariat.validateStep1", compact('programme','type_entreprise',"promoteur","nbre_ent_nn_traite"));
            }
        }
        elseif($programme=='PE'){
            if($promoteur->suscription_etape_pe==2){
                $entreprise= Entreprise::where("promoteur_id",$promoteur->id)->first();
                $entreprise=$entreprise->id;
                return view("programme_entreprendre.validateStep1", compact('programme','type_entreprise',"promoteur","entreprise",'nbre_ent_nn_traite'));
            }
                elseif($promoteur->suscription_etape_pe==1 || $promoteur->suscription_etape==null ){
                return view("programme_entreprendre.validateStep1", compact('programme','type_entreprise',"promoteur"));
            }
            else{
                return view("programme_entreprendre.validateStep1", compact('programme','type_entreprise',"promoteur","nbre_ent_nn_traite"));
            }

        }
        // }
        //     //S'il a une entreprise 
        // else{
        //     // Verifions si une de ses entreprise à un PCA
        //    // dd($nbre_ent_nn_traite);
        //     $projet=  DB::table('entreprises')
        //                 ->join('projets','projets.entreprise_id','entreprises.id')
        //                 ->where('entreprises.aopOuleader',"mpme")
        //                 ->where('entreprises.code_promoteur', $promoteur->code_promoteur)
        //                 ->first();
        //             //dd($projet);
        //     if($projet){
        //        // dd('dde');
        //         return view("invalide", compact("promoteur"));
        //     }
        //     else{
                
        //         if($promoteur->suscription_etape==2){
        //             $entreprise= Entreprise::where("promoteur_id",$promoteur->id )->first();
        //             $entreprise=$entreprise->id;
        //             return view("validateStep1", compact("promoteur","entreprise","nbre_ent_nn_traite"));
        //         }
        //         elseif($promoteur->suscription_etape==1 || $promoteur->suscription_etape==null ){
        //             return view("validateStep1", compact("promoteur","nbre_ent_nn_traite"));
        //         }
        //         return view("validateStep1", compact("promoteur", "nbre_ent_nn_traite"));
        //     }
        // }
       
       
    }
        /* S'Il n'ya pas d'entreprise pour lui
        il y'a juste le promoteur qui a été créé */
       
    }

    public function search_promoteur_parcode_promoteur(Request $request){

               $promoteur= Promoteur::where('code_promoteur',$request->code_promoteur)->first();
                if($promoteur){
                    return true;
                }else{
                    return false;
                }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promoteur  $promoteur
     * @return \Illuminate\Http\Response
     */
    public function show(Promoteur $promoteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promoteur  $promoteur
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $promoteur= Promoteur::where("slug", $slug)->first();
        $regions=Valeur::where('parametre_id',1 )->get();
        $niveau_instructions=Valeur::where("parametre_id", env('PARAMETRE_NIVEAU_D_INSTRUCTION'))->get();
        $occupation_professionnelle_actuelles =Valeur::where("parametre_id",env('PARAMETRE_OCCUPATION_PROFESSIONNELLE'))->get();
        return view("souscriptions.edit", compact("promoteur","regions","occupation_professionnelle_actuelles","niveau_instructions"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promoteur  $promoteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $promoteur= Promoteur::where("id",$id)->first();

        $promoteur->update(
            [
                'nom' => $request->nom_promoteur,
                'prenom' => $request->prenom_promoteur,
                'datenais' => $request->datenais_promoteur,
                'genre' => $request->genre,
                'telephone_promoteur' => $request->telephone_promoteur,
                'email_promoteur' => $request->email_promoteur,
                'type_identite' => $request->type_identite_promoteur,
                'numero_identite' => $request->numero_identite,
                'date_etabli_identite' => $request->date_identification,
                'date_expire_identite' => $request->date_identification,
                'autorite_delivrance' => $request->autorite_delivrance_identification,
                'mobile_promoteur' => $request->mobile_promoteur,
                'lieu_etablissement' => $request->lieu_etablissement_identification,
                'region_residence' => $request->region_residence,
                'province_residence' => $request->province_residence,
                'commune_residence' => $request->commune_residence,
                'situation_residence' => $request->situation_residence,
                'arrondissement_residence' => $request->arrondissement_residence,
                'niveau_instruction' => $request->niveau_instruction,
               // 'domaine_etude' => $request->domaine_etude,
                //'domaine_activite'=> $request->domaine_etude,
                'nombre_annee_experience'=> $request->nombre_annee_experience,
                'precision_residence' => $request->precision_residence,
                'formation_en_rapport_avec_activite' => $request->formation_activite,
                'occupation_professionnelle_actuelle' => $request->occupation_pro_actuelle,
                'membre_ass' => $request->membre_ass,
                'associations' => $request->associations,

        ]);
        return redirect()->route("souscription_a_valide_chefdezone");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promoteur  $promoteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promoteur $promoteur)
    {
        //
    }
     public function afficher(){
        $regions=Valeur::where('parametre_id',1 )->get();
        $niveau_instructions=Valeur::where("parametre_id",5)->get();
        $occupation_professionnelle_actuelles =Valeur::where("parametre_id",6)->get();
         return view("public.subscription", compact('regions', 'niveau_instructions','occupation_professionnelle_actuelles'));
     }
}
