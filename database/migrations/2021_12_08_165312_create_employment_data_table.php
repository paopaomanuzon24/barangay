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
            $table->unsignedBigInteger('user_id');
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
