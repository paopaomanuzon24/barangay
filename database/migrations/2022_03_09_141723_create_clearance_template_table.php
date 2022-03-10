<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearanceTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance_template', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("clearance_type_id");
            $table->unsignedBigInteger("clearance_category_id");
            $table->unsignedBigInteger("barangay_id");
            $table->unsignedBigInteger("template_image_id");
            $table->timestamps();

            $table->foreign('clearance_type_id')->references('id')->on('clearance_type');
            $table->foreign('clearance_category_id')->references('id')->on('clearance_category');
         #
            $table->foreign('barangay_id')->references('id')->on('barangays');
            $table->foreign('template_image_id')->references('id')->on('clearance_template_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clearance_template');
    }
}
