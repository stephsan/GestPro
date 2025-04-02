<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRealisationRequest;
use App\Http\Requests\UpdateRealisationRequest;
use App\Models\Realisation;

class RealisationController extends Controller
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
     * @param  \App\Http\Requests\StoreRealisationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRealisationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Realisation  $realisation
     * @return \Illuminate\Http\Response
     */
    public function show(Realisation $realisation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Realisation  $realisation
     * @return \Illuminate\Http\Response
     */
    public function edit(Realisation $realisation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRealisationRequest  $request
     * @param  \App\Models\Realisation  $realisation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRealisationRequest $request, Realisation $realisation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Realisation  $realisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Realisation $realisation)
    {
        //
    }
}
