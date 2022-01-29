<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPhotoToBarangayOfficialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangay_official', function (Blueprint $table) {
            $table->renameColumn('photo_file_name', 'file_name');
            $table->renameColumn('photo_path', 'file_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barangay_official', function (Blueprint $table) {
            //
        });
    }
}
