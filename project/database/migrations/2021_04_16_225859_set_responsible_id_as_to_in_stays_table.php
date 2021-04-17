<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetResponsibleIdAsToInStaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stays', function (Blueprint $table) {
            $table->bigInteger('responsible_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stays', function (Blueprint $table) {
            $table->bigInteger('responsible_id');
            $table->foreign('responsible_id')->references('id')->on('users');

        });
    }
}
