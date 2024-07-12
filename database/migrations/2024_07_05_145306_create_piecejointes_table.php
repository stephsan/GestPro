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
        Schema::create('piecejointes', function (Blueprint $table) {
            $table->id();
            $table->integer("type_piece");
            $table->integer("promoteur_id")->nullable();
            $table->integer("entreprise_id")->nullable();
            $table->integer("projet_id")->nullable();
            $table->string("url",100);
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
        Schema::dropIfExists('piecejointes');
    }
};
