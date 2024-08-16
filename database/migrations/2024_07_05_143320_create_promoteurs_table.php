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
        Schema::create('promoteurs', function (Blueprint $table) {
            $table->id();
            $table->string("nom",20);
            $table->string("prenom",50);
            $table->date("datenais");
            $table->integer("genre");
            $table->string("telephone_promoteur",15);
            $table->string("mobile_promoteur",15)->nullable();
            $table->string("email_promoteur",60)->nullable();
            $table->integer("region_residence");
            $table->integer("province_residence");
            $table->integer("commune_residence");
            $table->integer("arrondissement_residence");
            $table->string("precision_residence")->nullable();
            $table->integer("situation_residence");
            $table->integer("type_identite");
            $table->integer("avec_handicape")->nullable();
            $table->integer("type_handicap")->nullable();
            $table->string("numero_identite",30);
            $table->date("date_etabli_identite");
            $table->integer("niveau_instruction");
            $table->string("domaine_detude")->nullable();
            $table->string("autre_niveau_dinstruction")->nullable();
            $table->integer("formation_en_rapport_avec_activite");
            $table->integer("occupation_professionnelle_actuelle")->nullable();
            $table->string("numero_du_proche")->nullable();
            $table->string("code_promoteur",20);
            $table->integer("membre_ass");
            $table->integer("status")->nullable();
            $table->string("associations",)->nullable();
            $table->string("slug",20);
            $table->integer("suscription_etape")->nullable();
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
        Schema::dropIfExists('promoteurs');
    }
};
