<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("barangay_id")->nullable();
            $table->string("title")->nullable();
            $table->longText("content")->nullable();
            $table->date("date_from")->nullable();
            $table->date("date_to")->nullable();
            $table->string("img_path")->nullable();
            $table->string("img_name")->nullable();
            $table->boolean("pinned")->nullable();
            $table->unsignedBigInteger("created_by")->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('barangay_id')->references('id')->on('barangays');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
