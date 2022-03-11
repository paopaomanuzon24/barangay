<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDataToClearanceTemplateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clearance_template_image', function (Blueprint $table) {
            DB::table('clearance_template_image')->where("id", 1)->update(['file_name'=>'clearance_template_1.png']);
            DB::table('clearance_template_image')->where("id", 2)->update(['file_name'=>'clearance_template_2.png']);
            DB::table('clearance_template_image')->where("id", 3)->update(['file_name'=>'clearance_template_3.png']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clearance_template_image', function (Blueprint $table) {
            //
        });
    }
}
