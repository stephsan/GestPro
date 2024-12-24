<?php

namespace App\Http\Controllers;

use App\Models\GrilleEvalPca;
use App\Models\Valeur;
use Illuminate\Http\Request;

class GrilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $grilles= GrilleEvalPca::all();
      $rubriques=Valeur::where('parametre_id',55)->get();
      return view('grilles.index', compact('grilles','rubriques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        GrilleEvalPca::create([
            'categorie'=> $request->categorie, 
            'libelle'=> $request->libelle, 
            'ponderation'=> $request->ponderation, 
            'rubrique'=> $request->rubrique, 
        ]);
        return redirect()->route('grille.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GrillEvalPca  $grillEvalPca
     * @return \Illuminate\Http\Response
     */
    public function show(GrillEvalPca $grillEvalPca)
    {
        //
    }
    public function modifier(Request $request){
        $grille= GrilleEvalPca::find($request->id);
       // dd($grille);
        $data = array(
         'id'=>$grille->id,
         'libelle'=>$grille->libelle,
         'categorie'=> $grille->categorie, 
         'ponderation'=>$grille->ponderation,
         'rubrique'=>$grille->rubrique,
     );
     return json_encode($data);
 }
 public function modifierstore(Request $request){
    $grille= GrilleEvalPca::find($request->grille_id);
    $grille->update([
        'libelle'=> $request->libelle, 
        'categorie'=> $request->categorie, 
        'ponderation'=> $request->ponderation, 
        'rubrique'=> $request->rubrique, 
]);
    return redirect()->route('grille.index');

 }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GrillEvalPca  $grillEvalPca
     * @return \Illuminate\Http\Response
     */
    public function edit(GrilleEvalPca $grillEvalPca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GrillEvalPca  $grillEvalPca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrillEvalPca $grillEvalPca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrillEvalPca  $grillEvalPca
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrillEvalPca $grillEvalPca)
    {
        //
    }
}
