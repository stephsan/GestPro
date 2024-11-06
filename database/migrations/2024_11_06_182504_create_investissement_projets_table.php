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
        Schema::create('investissement_projets', function (Blueprint $table) {
            $table->id();
            $table->integer('designation');
            $table->integer('projet_id');
            $table->bigInteger('montant');
            $table->bigInteger('apport_perso');
            $table->bigInteger('subvention_demandee');
            $table->bigInteger('apport_perso_valide');
            $table->bigInteger('subvention_demandee_valide');
            $table->string('statut',100);
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
        Schema::dropIfExists('investissement_projets');
    }
};
