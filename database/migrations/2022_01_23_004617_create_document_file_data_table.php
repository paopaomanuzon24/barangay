<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentFileDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_file_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("document_data_id")->nullable();
            $table->string("file_name");
            $table->string("path_name");
            $table->timestamps();

            $table->foreign('document_data_id')->references('id')->on('document_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_file_data');
    }
}
