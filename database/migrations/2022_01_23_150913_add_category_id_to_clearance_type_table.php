<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToClearanceTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #DB::table('clearance_type')->whereIn('clearance_name',array('Indigency','Recidency','Barangay'))->delete();

        Schema::table('clearance_type', function (Blueprint $table) {
            $table->unsignedBigInteger("category_id");

        });
        DB::table('clearance_type')->where("id",1)->update(['category_id'=>1]);
        DB::table('clearance_type')->where("id",2)->update(['category_id'=>1,'clearance_name'=>'Residency']);
        DB::table('clearance_type')->where("id",3)->update(['category_id'=>1]);


        Schema::table('clearance_type', function (Blueprint $table) {

            $table->foreign('category_id')->references('id')->on('clearance_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clearance_type', function (Blueprint $table) {
            //
        });
    }
}
