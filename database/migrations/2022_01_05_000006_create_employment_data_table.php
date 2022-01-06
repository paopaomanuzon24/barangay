<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('usual_occupation_id')->nullable();
            $table->unsignedBigInteger('class_worker_id')->nullable();
            $table->unsignedBigInteger('work_affiliation_id')->nullable();
            $table->char('place_work_type', 1);
            $table->string('place_work_type_specify')->nullable();
            $table->char("employment_type", 1);
            $table->string("employment");
            $table->string("employment_address");
            $table->double("monthly_income", 20, 2);
            $table->double("annual_income", 20, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('usual_occupation_id')->references('id')->on('usual_occupation');
            $table->foreign('class_worker_id')->references('id')->on('class_worker');
            $table->foreign('work_affiliation_id')->references('id')->on('work_affiliation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employment_data');
    }
}
