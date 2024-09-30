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
            $table->string("eligible",30)->nullable();
            $table->text("commentaire_eligibilité")->nullable();
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
            $table->dropColumn('eligible');
            $table->dropColumn('commentaire_eligibilité');
        });
    }
};
