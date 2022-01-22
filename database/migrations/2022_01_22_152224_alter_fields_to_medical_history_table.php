<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsToMedicalHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_history', function (Blueprint $table) {
            $table->renameColumn('alocohol_no', 'alcohol_no');
            $table->renameColumn('commorbidity', 'comorbidity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_history', function (Blueprint $table) {
            //
        });
    }
}
