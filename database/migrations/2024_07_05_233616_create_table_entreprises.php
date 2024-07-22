<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("denomination");
            $table->integer("region");
            $table->integer("province");
            $table->integer("commune");
            $table->integer("arrondissement");
            $table->integer("categorie_entreprise"); //PROJET DE DEVELOPPEMENT OU INVESTISSEMENT VERTS
            $table->integer("secteur_activite");
            $table->integer("nombre_annee_existence");
            $table->integer("maillon_activite");
            $table->integer("formalise");
            $table->string("num_rccm")->nullable();
            $table->date("date_de_formalisation")->nullable();
            // $table->integer("nbre_innovation")->nullable();
            $table->integer("compte_dispo"); //Compte bancaire disponible
            $table->string("structure_financiere")->nullable(); // Structure financiaire disponible
            $table->string("code_promoteur",50);
            $table->integer("promoteur_id");
            // $table->integer("niveau_resilience");
            $table->integer("status");
            $table->integer("phase_de_souscription");
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entreprises');
    }
};
