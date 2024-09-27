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
        Schema::table('preprojets', function (Blueprint $table) {
            $table->string("statut")->nullable();
            $table->string("avis_de_lequipe",70)->nullable();
            $table->text("commentaires_de_lequipe")->nullable();
            $table->string("decision_du_comite",70)->nullable();
            $table->text("commentaire_du_comite")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preprojets', function (Blueprint $table) {
            $table->dropColumn('statut');
            $table->dropColumn('avis_de_lequipe');
            $table->dropColumn('commentaires_de_lequipe');
            $table->dropColumn('decision_du_comite');
            $table->dropColumn('commentaire_du_comite');
        });
    }
};
