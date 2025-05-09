<?php

namespace App\Http\Controllers;

use App\Models\Banque;
use App\Models\Entreprise;
use App\Models\Promotrice;
use App\Models\Role;
use App\Models\User;
use App\Models\Valeur;
use App\Models\PreprojetPe;
use App\Models\Preprojet;
use App\Models\Promoteur;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReinitialiseMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['register',"verifier_conformite_cpt",'storecomptePromoteur','login_form_beneficiaire']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
     if (Auth::user()->can('gerer_user')) {
        $users= User::orderBy('updated_at', 'desc')->get();
        return view('users.index', compact("users"));
      }
     else{
         return redirect()->back();
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    if (Auth::user()->can('gerer_user')) {
        $roles= Role::all();
        $zones=Valeur::where('parametre_id',1 )->whereIn('id', [env('VALEUR_ID_CENTRE'),env('VALEUR_ID_HAUT_BASSIN'), env('VALEUR_ID_CENTRE_OUEST'), env('VALEUR_ID_CENTRE_EST'), env('VALEUR_ID_NORD')])->get();
        $strucure_representees=Valeur::where('parametre_id',env("PARAMETRE_ID_REPRESENTANT_STRUCTURE") )->get();
        //$banques= Banque::all();
        return view("users.create", compact("roles", "zones","strucure_representees"));
     }
     else{
    //    flash("Vous n'avez pas le droit d'acceder à cette resource. Veillez contacter l'administrateur!!!")->error();
         return redirect()->back();
     }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_beneficiary_compte(Request $request){

    }   

    public function store(Request $request)
    {
     if (Auth::user()->can('gerer_user')) {
        $request->validate([
            "nom"=>"required",
            "email"=>"required|email"
        ]);
        if(isset($request['structure_rep'])){
            $structure_represente=$request['structure_rep'];
        }
        else{
            $structure_represente=0;
        }
    try{
       $user= User::create([
            "name"=>$request['nom'],
            "email"=>$request['email'],
            'prenom'=> $request ['prenom'],
            'zone' => $request ['organisation'],
            'telephone'=> $request ['telephone'],
            'email' => $request['email'],
            'structure_represente'=>$structure_represente,
            'firstcon' => 1,
            'password' => bcrypt('ecotec@2024')
        ]);
        $user->roles()->sync($request->roles);
       // flash("Utilisateur ajouté avec succes !!!")->success();
        return redirect()->route("users.index");
        }
        catch (QueryException $e) {
            return redirect()->back()->with('error',"Une erreur est survenue lors de la création du compte utilisateur");
            
        }
    }
     else{
    //     flash("Vous n'avez pas le droit d'acceder à cette resource. Veillez contacter l'administrateur!!!")->error();
        return redirect()->back();
     }
    }

  public function register(){
        return redirect()->route('index');
    }
public function reinitialize(Request $request){
            $user= User::find($request->id);
            $password = generate_password(8);
            $pass=$password;
            $user->update([
                'password' => bcrypt($pass)
            ]);
            $e_msg='Votre Mot de passe a ete initialise. Le nouveau mot de passe est : '.$password ;
            $titre= 'REINITIALISATION DE MOT DE PASSE DE LA PLATEFORME ECOTEC';
            $mail= $user->email;
            Mail::to($mail)->queue(new ReinitialiseMail($titre, $e_msg,'mails.reinitializeMail'));
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
    if (Auth::user()->can('gerer_user')) {
        $zones=Valeur::where('parametre_id',1 )->whereIn('id',[env('VALEUR_ID_CENTRE'),env('VALEUR_ID_HAUT_BASSIN'), env('VALEUR_ID_CENTRE_OUEST'), env('VALEUR_ID_CENTRE_EST'), env('VALEUR_ID_NORD')])->get();
        //$zones= Valeur::where("parametre_id",env("PRARAMETRE_ZONE"))->get();
        $roles=Role::all();
        $strucure_representees=Valeur::where('parametre_id',env("PARAMETRE_ID_REPRESENTANT_STRUCTURE") )->get();
         return view("users.update",compact(["user","roles","zones","strucure_representees"]));
    }
     else{
        //flash("Vous n'avez pas le droit d'acceder à cette resource. Veillez contacter l'administrateur!!!")->error();
         return redirect()->back()->with('error',"Vous ne disposez pas des droits requis pour acceder a cette ressource");
    }
 }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      if (Auth::user()->can('gerer_user')) {
        $request->validate([
            'nom'=>"required",
            'email'=>"required|email"
        ]);
        if($request['structure_rep'] == ""){
            $structure_represente=0;
        }
        else{
            $structure_represente=$request['structure_rep'];
        }
    try{
        $user->update([
            "name"=>$request['nom'],
            "email"=>$request['email'],
            'prenom'=> $request ['prenom'],
            'zone' => $request ['organisation'],
            'telephone'=> $request ['telephone'],
            'email' => $request['email'],
            //'banque_id'=>$request['banque'],
            'structure_represente'=>$structure_represente,
        ]);
        $user->roles()->sync($request->roles);
       // flash("Utilisateur modiffié avec succes !!!")->error();
        return redirect()->route("users.index")->with('success',"Utilisateur modifié avec success");
    }
    catch (QueryException $e) {
        return redirect()->back()->with('error',"Une erreur est survenue lors de l'enregistrement. Vérifier si cette adresse n'est pas déja dans la base de données");
        //return response()->json(['message' => 'Erreur inconnue'], 500);
    }
    }
         else{
    //        flash("Vous n'avez pas le droit d'acceder à cette resource. Veillez contacter l'administrateur!!!")->error();
             return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
public function updateuser(Request $request, User $user)
        {
     
            $user->update([
                    'name' => $request ['nom'],
                    'prenom'=> $request ['prenom'],
                    'telephone'=> $request ['telephone'],
                    'email' => $request['email']
                ]);

            if(!empty($request['password']))
            {
                $user->update([
                    'password' => bcrypt($request['password'])
                ]);
            }
            flash("Utilisateur modifié avec succès!!!")->error();
            return redirect()->back();
      
}
public function verifier_conformite_cpt(Request $request){ 
    $promoteur=Promoteur::where('code_promoteur',$request->code_promoteur)->first();
    if($promoteur){
        $preprojets= Preprojet::where('promoteur_id', $promoteur->id)->where('decision_du_comite','favorable')->get();
        $preprojet_pes= PreprojetPe::where('promoteur_id', $promoteur->id)->where('decision_du_comite','favorable')->get();
        $user=User::where("login",$request->code_promoteur)->first();
        if((!$preprojets && !$preprojet_pes) || $user){
            return 2;
        }
        elseif((count($preprojet_pes)>0)|| (count($preprojets)>0)){
            return 1;
        }else{
            return 0;
        }
    }else{
        return 2;
    }
    
   

}
public function storecomptePromoteur(Request $request){
    $request->validate([
        'code_promoteur'=>'unique:users|max:255',
        'password' => 'required|confirmed|min:6',
        //'email' => 'required|email|unique:users,email',
    ]);
    $promoteur=Promoteur::where('code_promoteur',$request->code_promoteur)->first();
    if(isset($request['code_promoteur'], $request['email'])){
        try{
            $user= User::create([
                "name"=>$promoteur['nom'],
                "email"=>$request['email'],
                'prenom'=> $promoteur['prenom'],
                'telephone'=> $request ['telephone'],
                'email' => $request['email'],
                'isbeneficiary' => 1,
                'login' => $request['code_promoteur'],
                'password' => bcrypt($request['password'])
            ]);
            return redirect()->back()->with('success',"Votre compte été créé avec success");
        }
        catch (QueryException $e) {
            return redirect()->back()->with('error',"Une erreur est survenue lors de la création du compte utilisateur");
            //return response()->json(['message' => 'Erreur inconnue'], 500);
        }
        }
        
    }
   
   
    

public function logout(Request $request) {
    if(Auth::user()->code_promoteur==null){
        Auth::logout();
        return redirect()->route('login');
    }
    else{
        Auth::logout();
        return redirect()->route('accueil');
    }
   
}
public function login_form_beneficiaire(){
    return view("public.login_beneficiaire");
}

}
