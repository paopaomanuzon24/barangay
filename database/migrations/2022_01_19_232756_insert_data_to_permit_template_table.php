<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertDataToPermitTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permit_template', function (Blueprint $table) {
            //
        });
        DB::table('permit_template')->insert([
            'description' => 'Template No. 1',
            'file_name' => 'template_1',
            'file_path' => 'public/images/permit/template',
        ]);
        DB::table('permit_template')->insert([
            'description' => 'Template No. 2',
            'file_name' => 'template_2',
            'file_path' => 'public/images/permit/template',
        ]);
        DB::table('permit_template')->insert([
            'description' => 'Template No. 3',
            'file_name' => 'template_3',
            'file_path' => 'public/images/permit/template',
        ]);
        DB::table('permit_template')->insert([
            'description' => 'Template No. 4',
            'file_name' => 'template_4',
            'file_path' => 'public/images/permit/template',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permit_template', function (Blueprint $table) {
            //
        });
    }
}
