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
            $table->string('avis_chefdantenne')->nullable();
            $table->string('observation_chefdantenne')->nullable();
            $table->string('avis_equipe_fp')->nullable();
            $table->string('observation_equipe_fp')->nullable();

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
            $table->dropColumn('avis_chefdantenne');
            $table->dropColumn('observation_chefdantenne');
            $table->dropColumn('avis_equipe_fp');
            $table->dropColumn('observation_equipe_fp');
        });
    }
};
