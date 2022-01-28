<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDataToVaccinesTable extends Migration
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

        DB::table('vaccines')->where("id", 1)->update(['description'=>'Polio Vaccine']);
        DB::table('vaccines')->where("id", 2)->update(['description'=>'Flu Vaccine']);
        DB::table('vaccines')->where("id", 3)->update(['description'=>'Diphtheria-Tetanus-Pertussis Vaccine']);
        DB::table('vaccines')->where("id", 4)->update(['description'=>'Hepatitis B Vaccine']);
        DB::table('religious')->insert([
            [
                'description' => 'Hepatitis A Vaccine'
            ],
            [
                'description' => 'Measles-Mumps-Rubella Vaccine'
            ],
            [
                'description' => 'Hib Vaccine'
            ],
            [
                'description' => 'Pneumococcal Conjugate Vaccine (For Pneumonia)'
            ],
            [
                'description' => 'RotaTeq Vaccine'
            ],
            [
                'description' => 'Varicella Vaccine (For Chickenfox)'
            ],
            [
                'description' => 'Shingles Vaccine'
            ],
            [
                'description' => 'Covid Vaccine'
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
