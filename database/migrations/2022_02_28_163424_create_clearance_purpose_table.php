<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearancePurposeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance_purpose', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("clearance_type_id");
            $table->unsignedBigInteger("clearance_category_id");
            $table->unsignedBigInteger("barangay_id");
            $table->longText('purpose')->nullable();
            $table->unsignedBigInteger("created_by");
            $table->timestamps();

            $table->foreign('clearance_type_id')->references('id')->on('clearance_type');
            $table->foreign('clearance_category_id')->references('id')->on('clearance_category');
            $table->foreign('barangay_id')->references('id')->on('barangays');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clearance_purpose');
    }
}
