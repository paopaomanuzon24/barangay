<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("template_id")->nullable();
            $table->unsignedBigInteger("permit_type_id");
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("barangay_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("payment_method_id");
            $table->unsignedBigInteger("status");
            $table->string("control_number");
            $table->timestamps();

            $table->foreign('permit_type_id')->references('id')->on('permit_type');
            $table->foreign('category_id')->references('id')->on('permit_category');
            $table->foreign('barangay_id')->references('id')->on('barangays');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permit_history');
    }
}
