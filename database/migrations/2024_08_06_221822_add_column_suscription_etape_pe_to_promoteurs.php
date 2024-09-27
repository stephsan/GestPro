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
        Schema::table('promoteurs', function (Blueprint $table) {
            $table->integer("suscription_etape_pe");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promoteurs', function (Blueprint $table) {
            $table->dropColumn('suscription_etape_pe');
        });
    }
};
