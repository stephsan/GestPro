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
        Schema::create('preprojets', function (Blueprint $table) {
            $table->id();
            $table->string("titre_projet");
            $table->integer("secteur_dactivite");
            $table->integer("maillon_dactivite");
            $table->integer("region");
            $table->integer("province");
            $table->integer("commune");
            $table->integer("secteur_village");
            $table->integer("aggrement_exige");
            $table->integer("promesse_de_financement");
            $table->integer("origine_clientele");
            $table->integer("type_clientele");
            $table->integer("site_disponible");
            $table->text("description");
            $table->text("objectifs");
            $table->string("num_projet",100);
            $table->string("slug",100);
            $table->integer("promoteur_id")->nullable();
            $table->bigInteger("cout_total");
            $table->bigInteger("apport_personnel");
            $table->bigInteger("subvention_souhaite");
            $table->bigInteger("autre_ninancement");
            $table->integer("entreprise_id")->nullable();
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
        Schema::dropIfExists('preprojets');
    }
};
