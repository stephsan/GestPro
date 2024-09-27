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
        Schema::create('preprojet_parametres', function (Blueprint $table) {
            $table->id();
            $table->integer("preprojet_pe_id")->nullable();
            $table->integer("preprojet_fp_id")->nullable();
            $table->integer("parametre_id");
            $table->integer("valeur_id");
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
        Schema::dropIfExists('preprojet_parametres');
    }
};
