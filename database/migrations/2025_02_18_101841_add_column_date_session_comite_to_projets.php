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
        Schema::table('projets', function (Blueprint $table) {
            $table->integer('montant_accorde')->nullable();
            $table->text('observations_comite')->nullable();
            $table->date('date_session_comite')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projets', function (Blueprint $table) {
            $table->dropColumn('montant_accorde');
            $table->dropColumn('observations_comite');
            $table->dropColumn('date_session_comite');

        });
    }
};
