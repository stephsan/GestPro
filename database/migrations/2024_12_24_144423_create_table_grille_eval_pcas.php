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
        Schema::create('grille_eval_pcas', function (Blueprint $table) {
            $table->id();
            $table->string("libelle",100)->nullable();
            $table->integer("ponderation")->nullable();
            $table->string("categorie",20)->nullable(); //Startup ou MPME existant
            $table->integer("rubrique")->nullable(); //la rubrique du critere vient de la table parametre valeur
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grille_eval_pcas');
    }
};
