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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checkup_id')->unsigned();
            $table->bigInteger('medicine_id')->unsigned();
            $table->Integer('amount');
            $table->bigInteger('total_cost');
            $table->string('recipe');
            $table->timestamps();

            $table->foreign('checkup_id')->references('id')->on('checkups');
            $table->foreign('medicine_id')->references('id')->on('medicines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
};
