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
        Schema::table('criteres', function (Blueprint $table) {
            $table->string("type_entreprise");
            $table->integer("rubrique_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('criteres', function (Blueprint $table) {
            $table->dropColumn('type_entreprise');
           $table->dropColumn('rubrique_id');
        });
    }
};
