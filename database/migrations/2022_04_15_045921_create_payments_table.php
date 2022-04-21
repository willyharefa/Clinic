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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('no_payment');
            $table->string('name_patient');
            $table->bigInteger('checkup_id')->unsigned();
            $table->bigInteger('total_cost');
            $table->bigInteger('paid');
            $table->bigInteger('refund');
            $table->timestamps();

            $table->foreign('checkup_id')->references('id')->on('checkups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
