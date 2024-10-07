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
        Schema::table('preprojet_pes', function (Blueprint $table) {
            $table->string("statut")->nullable();
            $table->string("avis_de_lequipe",70)->nullable();
            $table->text("commentaires_de_lequipe")->nullable();
            $table->string("decision_du_comite",70)->nullable();
            $table->text("commentaire_du_comite")->nullable();
            $table->text("commentaire_evaluation")->nullable();
            $table->string("eligible",30)->nullable();
            $table->text("commentaire_eligibilité")->nullable();
            $table->string("zone_daffectation")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preprojet_pes', function (Blueprint $table) {
            $table->dropColumn('statut');
            $table->dropColumn('avis_de_lequipe');
            $table->dropColumn('commentaires_de_lequipe');
            $table->dropColumn('decision_du_comite');
            $table->dropColumn('commentaire_du_comite');
            $table->dropColumn("commentaire_evaluation");
            $table->dropColumn('eligible');
            $table->dropColumn('commentaire_eligibilité');
            $table->dropColumn('zone_daffectation');

        });
    }
};
