<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActiviteRequest;
use App\Http\Requests\UpdateActiviteRequest;
use App\Models\Activite;
use App\Models\Composante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActiviteController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActiviteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $composante=Composante::find($request->composante_id);

        $year=date("Y");
        $lastOne = DB::table('activites')->latest('id')->first();
        if($lastOne){
            $code_activite = $lastOne->id+1;
        }
        else{
            $code_activite = 0+1;
        }
        //dd($code_activite);
        Activite::create([
            'libelle'=>$request->libelle,
            'composante_id'=>$request->composante_id,
            'categorie_id'=>$request->categorie_id,
            'code_activite'=>'A'.$year.'P'.$composante->projet->id.'C'.$composante->id.$composante->code_composante.'A'.$code_activite,
        ]);
       
        return redirect()->back()->with('success',"L'activité a été enregistrée avec succes");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function show(Activite $activite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function edit(Activite $activite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActiviteRequest  $request
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActiviteRequest $request, Activite $activite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activite $activite)
    {
        //
    }
}
