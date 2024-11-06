<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Valeur;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
class SouscriptionPEController extends Controller
{
    function create_personne(Request $request){
        //return redirect()->back();
        $type_entreprise=$request->type_entreprise;
        $programme=$request->programme;
        $occupation_professionnelle_actuelles =Valeur::where("parametre_id",env('PARAMETRE_OCCUPATION_PROFESSIONNELLE'))->get();
        $regions=Valeur::where('parametre_id',env('PARAMETRE_ID_REGION'))->get();
        $nbre_dannee_experiences=Valeur::where('parametre_id',22 )->get();
        $niveau_instructions=Valeur::where("parametre_id", env('PARAMETRE_NIVEAU_D_INSTRUCTION'))->get();
        $type_handicaps= Valeur::where('parametre_id', 48)->get();
        return view('programme_entreprendre.personne',compact('programme','occupation_professionnelle_actuelles','type_handicaps','type_entreprise','nbre_dannee_experiences','regions','niveau_instructions'));
    }

    public function contactSendMessage(Request $request){
       
        $captcha = null;
 
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
    }
    if (!$captcha) {
        echo 'nocaptcha';
        return;
    }
    $client = new \GuzzleHttp\Client();
    
    $response = $client->request (
        'POST',
        'https://www.google.com/recaptcha/api/siteverify', [
        'form_params' => [
            'secret' => '6Lfkm9MiAAAAAFO6QMGqs-zhSLa1U4NiLwNYaxpx',
            'response' => $captcha,
        ]
    ]);
    $responses = json_decode ($response->getBody ());
    if ($responses->success) {
        $this->validate($request, [
    		'nom'=> "required",
    		'email'=> "required",
    		'message'=> "required",
    	]);
    	$nom = $request->nom;
    	$email = $request->email;
        $telephone = $request->telephone;
        $region = $request->region;
    	$message = $request->message."."."Je suis dans la zone: ".$region." ."."Mon adresse email est :".$email;
    	$email_equipe = env('EMAIL_CONTACT_SUPPORT');
    	$reponse = env('MESSAGE_ASSISTANCE');
    	Contact::create([
    		'nom'=>$nom,
            //'telephone'=>$telephone,
    		'email'=>$email,
    		'message'=>$message

    	]);

    	//// MAIL POUR L'EQUIPE TECHNIQUE
    	Mail::to($email_equipe)->send( new ContactMail($nom, $message, $telephone,  'mails.contactMail') );
        $contact=Mail::to($email);
    	// echo $contact->send(new ContactMail($nom, $reponse, $telephone, 'mails.contactReponse'));
                return 'OK';
    } else {
        echo 'fail';
    }
       
    }
    function create_entreprise(){
        $regions=Valeur::where('parametre_id',env('PARAMETRE_ID_REGION'))->get();
        $niveau_instructions=Valeur::where("parametre_id", env('PARAMETRE_NIVEAU_D_INSTRUCTION'))->get();
        $regions=Valeur::where('parametre_id',1 )->get();
        $forme_juridiques=Valeur::where('parametre_id',8 )->get();
        $nature_clienteles=Valeur::where('parametre_id',10 )->get();
        $provenance_clients=Valeur::where('parametre_id',9 )->get();
        $maillon_activites=Valeur::where('parametre_id',7 )->get();
        $source_appros=Valeur::where('parametre_id',12 )->get();
        $sys_suivi_activites=Valeur::where('parametre_id',13 )->get();
        $annees=Valeur::where('parametre_id',16 )->where('id','!=', 46)->get();
        $futur_annees=Valeur::where('parametre_id',17 )->get();
        $rentabilite_criteres=Valeur::where('parametre_id',14)->where('id','!=',env("VALEUR_ID_NOMBRE_CLIENT"))->whereNotIn('id',[7098,7099,7100,7101,7102,7116])->get();
        $effectifs=Valeur::where('parametre_id',15 )->get();
        $secteur_activites= Valeur::where('parametre_id', env('PARAMETRE_SECTEUR_ACTIVITE_ID') )->get();
        $secteur_activites= Valeur::where('parametre_id', env('PARAMETRE_SECTEUR_ACTIVITE_ID') )->get();
        $nb_annee_activites= Valeur::where('parametre_id', env('PARAMETRE_NB_ANNEE_EXISTENCE_ENT') )->get();
        $techno_utilisees= Valeur::where('parametre_id', env('PARAMETRE_TECHNO_UTILISE_ENTREPRISE_ID') )->get();
        $nouveaute_entreprises=Valeur::where('parametre_id',env("PARAMETRE_INOVATION_ENTREPRISE_ID") )->get();
        $ouinon_reponses=Valeur::where('parametre_id',env("PARAMETRE_REPONSES_OUINON_ID") )->get();
        $niveau_resiliences=Valeur::where('parametre_id',env("PARAMETRE_NIVEAUDE_RESILIENCE_ID") )->get();
        return view('programme_entreprendre.entreprise', compact("regions","forme_juridiques","nature_clienteles","provenance_clients","maillon_activites","source_appros","sys_suivi_activites","annees","rentabilite_criteres","effectifs", "nb_annee_activites","secteur_activites","techno_utilisees","nouveaute_entreprises","ouinon_reponses","niveau_resiliences"));
    }
}
