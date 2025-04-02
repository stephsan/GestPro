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
        Schema::create('composantes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('code_composante')->nullable();
            $table->integer('projet_id')->nullable();
            $table->string('denomination')->nullable();
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
        Schema::dropIfExists('composantes');
    }
};
