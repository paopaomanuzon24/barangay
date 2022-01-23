<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeToDocumentFileDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_file_data', function (Blueprint $table) {
            $table->dropForeign('document_file_data_document_data_id_foreign');
            $table->foreign('document_data_id')
                ->references('id')
                ->on('document_data')
                ->onDelete('cascade')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_file_data', function (Blueprint $table) {
            //
        });
    }
}
