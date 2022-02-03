<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsToBlotterAndComplainDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blotter_and_complain_data', function (Blueprint $table) {
            $table->string('blotter_complainant')->nullable();
            $table->string('blotter_complainee')->nullable();
            $table->string('blotter_subject')->nullable();
            $table->string('blotter_address')->nullable();
            $table->renameColumn('blotter_message', 'blotter_complaint_content');

            // For BLotter Resolution
            // status
            // amount
            // date resolved
            $table->longText('blotter_agreement_content')->nullable();
            $table->dropColumn('blotter_fee');
            $table->double('blotter_amount', 8, 2)->nullable();
            $table->unsignedBigInteger('blotter_payment_method_id')->nullable();
            $table->string('blotter_receipt_file_path')->nullable();
            $table->string('blotter_receipt_file_name')->nullable();
            $table->boolean('is_waived')->nullable();
            $table->string('blotter_waive_reason')->nullable();
            $table->dateTime('blotter_date_resolved', $precision = 0)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blotter_and_complain_data', function (Blueprint $table) {
            //
        });
    }
}
