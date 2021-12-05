<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('level');
            $table->timestamps();
        });

        DB::table('user_type')->insert([
            [
                'name' => 'super admin',
                'level' => 1
            ],
            [
                'name' => 'admin',
                'level' => 2
            ],
            [
                'name' => 'treasury',
                'level' => 3
            ],
            [
                'name' => 'secretary',
                'level' => 4
            ],
            [
                'name' => 'resident',
                'level' => 5
            ],
            [
                'name' => 'applicant',
                'level' => 6
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
        Schema::dropIfExists('user_type');
    }
}
