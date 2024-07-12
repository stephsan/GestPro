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
        Schema::create('infoeffectifentreprises', function (Blueprint $table) {
            $table->id();
            $table->integer("annee");
            $table->integer("effectif");
            $table->integer("homme");
            $table->integer("femme");
            $table->string("code_promoteur");
            $table->integer("entreprise_id")->nullable();
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
        Schema::dropIfExists('infoeffectifentreprises');
    }
};
