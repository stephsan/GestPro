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
        Schema::create('preprojet_pes', function (Blueprint $table) {
            $table->id();
            $table->string("titre_projet");
            $table->integer("secteur_dactivite");
            $table->integer("maillon_dactivite");
            $table->integer("region");
            $table->integer("province");
            $table->integer("commune");
            $table->integer("secteur_village");
            $table->integer("type_site")->nullable();
            // $table->integer("guichet");
            $table->integer("origine_clientele");
            $table->integer("type_clientele");
            $table->integer("site_disponible");
            $table->text("description");
            $table->text("objectifs");
            $table->string("num_projet",100);
            $table->integer("forme_juridique_envisage");
            $table->integer("aggrement_exige");
            $table->string("precise_aggrement")->nullable();
            $table->string("autre_besoin_en_formation")->nullable();
            $table->integer("existence_dexprerience_du_promoteur");
            $table->integer("mode_dacquisition_dexprerience_du_promoteur")->nullable();
            $table->integer("etude_technique_de_faisabilite");
            $table->integer("etude_de_marche");
            $table->integer("prototype_existe");
            $table->integer("recherche_de_financement_envisage");
            $table->string("slug",100);
            $table->integer("promoteur_id")->nullable();
   
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
        Schema::dropIfExists('preprojet_pes');
    }
};
