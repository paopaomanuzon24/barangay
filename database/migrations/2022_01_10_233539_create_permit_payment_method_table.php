<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitPaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_payment_method', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('permit_payment_method')->insert([
            'description' => 'Payment on Pick-up',
        ]);
        DB::table('permit_payment_method')->insert([
            'description' => 'Bank Transfer',
        ]);
        DB::table('permit_payment_method')->insert([
            'description' => 'Gcash',
        ]);
        DB::table('permit_payment_method')->insert([
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
        Schema::dropIfExists('permit_payment_method');
    }
}
