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
            $table->unsignedBigInteger("template_id");
            $table->unsignedBigInteger("permit_type_id");
            $table->unsignedBigInteger("barangay_id");
            $table->string("control_number");
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
        Schema::dropIfExists('permit_history');
    }
}
