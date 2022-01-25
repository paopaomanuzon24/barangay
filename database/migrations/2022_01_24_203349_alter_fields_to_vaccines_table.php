<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Vaccine;

class AlterFieldsToVaccinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vaccines', function (Blueprint $table) {
            // 
        });

        Vaccine::find(1)->delete();

        DB::table('vaccines')->insert([
            [
                'description' => 'COVID-19 vaccine'
            ],
            [
                'description' => 'Measles Vaccine'
            ],
            [
                'description' => 'Varicella Vaccine'
            ],
            [
                'description' => 'Influenza Vaccine'
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
        Schema::table('vaccines', function (Blueprint $table) {
            //
        });
    }
}
