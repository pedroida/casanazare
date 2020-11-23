<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');

            $table->bigInteger('donation_category_id');
            $table->foreign('donation_category_id')
                ->references('id')
                ->on('donation_categories');

            $table->bigInteger('donation_unit_id');
            $table->foreign('donation_unit_id')
                ->references('id')
                ->on('donation_units');

            $table->float('quantity', 8, 3)->default(0);

            $table->date('validate')->nullable();

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
        Schema::dropIfExists('donations');
    }
}
