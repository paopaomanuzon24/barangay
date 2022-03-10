<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertDataToClearanceTemplateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clearance_template_image', function (Blueprint $table) {
            DB::table('clearance_template_image')->insert([
                'description' => 'Template No. 1',
                'file_name' => 'clearance_template_1',
                'file_path' => 'public/images/clearance_template',
            ]);
            DB::table('clearance_template_image')->insert([
                'description' => 'Template No. 2',
                'file_name' => 'clearance_template_2',
                'file_path' => 'public/images/clearance_template',
            ]);
            DB::table('clearance_template_image')->insert([
                'description' => 'Template No. 3',
                'file_name' => 'clearance_template_3',
                'file_path' => 'public/images/clearance_template',
            ]);


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
