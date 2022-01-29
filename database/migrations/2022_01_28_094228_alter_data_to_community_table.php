<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDataToCommunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('community', function (Blueprint $table) {
            //
        });

        DB::table('community')->where("id", 1)->update(['description'=>'Lesbian']);
        DB::table('community')->where("id", 2)->update(['description'=>'Gay']);
        DB::table('community')->where("id", 3)->update(['description'=>'Bisexual']);
        DB::table('community')->where("id", 4)->update(['description'=>'Transgender']);
        DB::table('community')->insert([
            [
                'description' => 'Queer'
            ],
            [
                'description' => 'Intersex'
            ],
            [
                'description' => 'Asexual'
            ],
            [
                'description' => 'Two-Spirit'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('community', function (Blueprint $table) {
            //
        });
    }
}
