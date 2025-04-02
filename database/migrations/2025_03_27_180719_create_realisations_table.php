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
        Schema::create('realisations', function (Blueprint $table) {
            $table->id();
            $table->integer('activite_id');
            $table->string('annee',6);
            $table->float('taux_physique');
            $table->float('taux_financier');
            $table->float('taux_decaissement');
            $table->float('delais_consomme');
            $table->float('cible_prevu');
            $table->float('cible_realise');
            $table->float('taux_cible');
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
        Schema::dropIfExists('realisations');
    }
};
