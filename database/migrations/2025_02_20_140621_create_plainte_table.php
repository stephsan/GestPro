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
        Schema::create('plaintes', function (Blueprint $table) {
            $table->id();
            $table->string('nom',30);
            $table->string('prenom',50);
            $table->string('telephone',60);
            $table->string('email',60);
            $table->integer('region');
            $table->integer('sexe');
            $table->integer('province');
            $table->integer('commune');
            $table->integer('secteur');
            $table->string('nom_personne_en_cause',30)->nullable();
            $table->string('prenom_personne_en_cause',50)->nullable();
            $table->text('objet');
            $table->text('solution_preconisee');
            $table->string('statut',20);
            $table->date('date_cloture',20)->nullable();
            $table->integer('categorie')->nullable();
            $table->integer('recevablilite')->nullable(); //Boolean si recevable =1 sinon 0
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
        Schema::dropIfExists('plaintes');
    }
};
