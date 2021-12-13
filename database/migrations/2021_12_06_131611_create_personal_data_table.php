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
            $table->unsignedBigInteger('resident_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->char('gender', 1);
            $table->unsignedBigInteger('marital_status_id');
            $table->unsignedBigInteger('religious_id');
            $table->char('citizenship', 1);
            $table->unsignedBigInteger('citizenship_id')->nullable();
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('contact_no', 15);
            $table->string('land_line', 15)->nullable();
            $table->string('additional_contact_no', 15)->nullable();
            $table->string('emergency_contact_no', 15)->nullable();
            $table->string('email');
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
        Schema::dropIfExists('personal_data');
    }
}
