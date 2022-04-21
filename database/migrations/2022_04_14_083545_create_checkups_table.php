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
        Schema::create('checkups', function (Blueprint $table) {
            $table->id();
            $table->string('no_medical_record');
            $table->bigInteger('appointmen_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('doctor_id')->unsigned();
            $table->date('date_checkup');
            $table->string('grievance');
            $table->string('result_diagnoses');
            $table->bigInteger('service_price');
            $table->boolean('paid')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('appointmen_id')->references('id')->on('appointmens');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkups');
    }
};
