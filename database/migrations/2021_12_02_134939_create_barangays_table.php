<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
        });

        DB::table('barangays')->insert([
            [
                'description' => 'Acacia'
            ],
            [
                'description' => 'Baritan'
            ],
            [
                'description' => 'Bayan-Bayanan'
            ],
            [
                'description' => 'Catmon'
            ],
            [
                'description' => 'Concepcion'
            ],
            [
                'description' => 'Dampalit'
            ],
            [
                'description' => 'Flores'
            ],
            [
                'description' => 'Hulong Duhat'
            ],
            [
                'description' => 'Ibaba'
            ],
            [
                'description' => 'Longos'
            ],
            [
                'description' => 'Maysilo'
            ],
            [
                'description' => 'Muzon'
            ],
            [
                'description' => 'Niugan'
            ],
            [
                'description' => 'Panghulo'
            ],
            [
                'description' => 'Potrero'
            ],
            [
                'description' => 'San Agustin'
            ],
            [
                'description' => 'Santolan'
            ],
            [
                'description' => 'Tañong'
            ],
            [
                'description' => 'Tinajeros'
            ],
            [
                'description' => 'Tonsuya'
            ],
            [
                'description' => 'Tugatog'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangays');
    }
}
