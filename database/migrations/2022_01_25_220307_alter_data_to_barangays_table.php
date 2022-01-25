<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDataToBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangays', function (Blueprint $table) {
            $table->string('code');
        });

        DB::table('barangays')->where("id", 1)->update(['code'=>'ACA']);
        DB::table('barangays')->where("id", 2)->update(['code'=>'BAR']);
        DB::table('barangays')->where("id", 3)->update(['code'=>'BAY']);
        DB::table('barangays')->where("id", 4)->update(['code'=>'CAT']);
        DB::table('barangays')->where("id", 5)->update(['code'=>'CON']);
        DB::table('barangays')->where("id", 6)->update(['code'=>'DAM']);
        DB::table('barangays')->where("id", 7)->update(['code'=>'FLO']);
        DB::table('barangays')->where("id", 8)->update(['code'=>'HUL']);
        DB::table('barangays')->where("id", 9)->update(['code'=>'IBA']);
        DB::table('barangays')->where("id", 10)->update(['code'=>'LON']);
        DB::table('barangays')->where("id", 11)->update(['code'=>'MAY']);
        DB::table('barangays')->where("id", 12)->update(['code'=>'MUZ']);
        DB::table('barangays')->where("id", 13)->update(['code'=>'NIU']);
        DB::table('barangays')->where("id", 14)->update(['code'=>'PAN']);
        DB::table('barangays')->where("id", 15)->update(['code'=>'POT']);
        DB::table('barangays')->where("id", 16)->update(['code'=>'SAG']);
        DB::table('barangays')->where("id", 17)->update(['code'=>'SAN']);
        DB::table('barangays')->where("id", 18)->update(['code'=>'TAN']);
        DB::table('barangays')->where("id", 19)->update(['code'=>'TIN']);
        DB::table('barangays')->where("id", 20)->update(['code'=>'TON']);
        DB::table('barangays')->where("id", 21)->update(['code'=>'TUG']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barangays', function (Blueprint $table) {
            //
        });
    }
}
