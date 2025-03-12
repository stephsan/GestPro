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
            $table->string('avis_ses')->nullable();
            $table->integer('categorie_projet')->nullable();
            $table->string('decision_aneve')->nullable();
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
            $table->dropColumn('avis_ses');
            $table->dropColumn('decision_aneve');
            $table->dropColumn('categorie_projet');
        });
    }
};
