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
            $table->integer("experience_du_promoteur");
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
            $table->dropColumn('experience_du_promoteur');
        });
    }
};
