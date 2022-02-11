<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineInventoryStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_inventory_status', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });
        DB::table('medicine_inventory_status')->insert([
            'description' => 'In stock',
        ]);
        DB::table('medicine_inventory_status')->insert([
            'description' => 'Out of stock',
        ]);
        DB::table('medicine_inventory_status')->insert([
            'description' => 'Needs restock',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_inventory_status');
    }
}
