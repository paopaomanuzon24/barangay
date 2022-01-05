<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('application_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->char('gender', 1);
            $table->unsignedBigInteger('marital_status_id');
            $table->unsignedBigInteger('religious_id');
            $table->char('citizenship', 1)->nullable();
            $table->unsignedBigInteger('citizenship_id')->nullable();
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('contact_no', 15);
            $table->string('land_line', 15)->nullable();
            $table->string('additional_contact_no', 15)->nullable();
            $table->string('emergency_contact_no', 15)->nullable();
            $table->string('email');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('marital_status_id')->references('id')->on('marital_status');
            $table->foreign('religious_id')->references('id')->on('religious');
            $table->foreign('citizenship_id')->references('id')->on('citizenship');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_data');
    }
}
