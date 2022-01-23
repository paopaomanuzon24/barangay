<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearancePaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance_payment_method', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('clearance_payment_method')->insert([
            'description' => 'Payment on Pick-up',
        ]);
        DB::table('clearance_payment_method')->insert([
            'description' => 'Bank Transfer',
        ]);
        DB::table('clearance_payment_method')->insert([
            'description' => 'Gcash',
        ]);
        DB::table('clearance_payment_method')->insert([
            'description' => 'Request for waive',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clearance_payment_method');
    }
}
