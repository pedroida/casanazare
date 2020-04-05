<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stays', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('type');

            $table->bigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');

            $table->bigInteger('source_id');
            $table->foreign('source_id')->references('id')->on('sources');

            $table->bigInteger('responsible_id');
            $table->foreign('responsible_id')->references('id')->on('users');

            $table->date('entry_date');

            $table->date('departure_date');

            $table->text('comments')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stays');
    }
}
