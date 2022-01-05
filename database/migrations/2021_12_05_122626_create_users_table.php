<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->string('username');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('contact_no', 15);
            $table->char('gender', 1);
            $table->date('birth_date');
            $table->string('address');
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('user_type_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('barangay_id')->references('id')->on('barangays');
            $table->foreign('user_type_id')->references('id')->on('user_type');
        });

        // DB::statement(
        //     // "ALTER TABLE performance ADD FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE"
        //     "ALTER TABLE users ADD FOREIGN KEY (barangay_id) REFERENCES barangays(id)"
        // );

        // DB::statement(
        //     "ALTER TABLE users ADD FOREIGN KEY (user_type_id) REFERENCES user_type(id)"
        // );

        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'barangay_id' => 1,
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 2
        ]);

        // DB::table('users')->insert([
        //     'first_name' => 'Super Admin',
        //     'last_name' => 'Super Admin',
        //     'email' => 'superadmin@gmail.com',
        //     'contact_no' => '0987654321',
        //     'gender' => 'M',
        //     'birth_date' => '1999-01-08',
        //     'address' => '123 fake street',
        //     // 'barangay_id' => NULL,
        //     'password' => Hash::make("Pass1234!"),
        //     'user_type_id' => 1
        // ]);

        DB::table('users')->insert([
            'first_name' => 'User',
            'last_name' => 'User',
            'email' => 'user@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'barangay_id' => 1,
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 6
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
