<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });

        DB::table('users')->insert([
            'first_name' => 'Super Admin',
            'last_name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 1
        ]);

        DB::table('users')->insert([
            'first_name' => 'Acacia Admin',
            'last_name' => 'Acacia Admin',
            'email' => 'acacia@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'barangay_id' => 1,
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'email' => 'juan@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'barangay_id' => 1,
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 6
        ]);

        DB::table('users')->insert([
            'first_name' => 'Treasury',
            'last_name' => 'Treasury',
            'email' => 'treasury@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'barangay_id' => 1,
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 3
        ]);

        DB::table('users')->insert([
            'first_name' => 'Secretary',
            'last_name' => 'Secretary',
            'email' => 'secretary@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'barangay_id' => 1,
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 4
        ]);

        DB::table('users')->insert([
            'first_name' => 'Longos Admin',
            'last_name' => 'Longos Admin',
            'email' => 'longos@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'barangay_id' => 10,
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Niugan Admin',
            'last_name' => 'Niugan Admin',
            'email' => 'niugan@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'barangay_id' => 13,
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Potrero Admin',
            'last_name' => 'Potrero Admin',
            'email' => 'potrero@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'barangay_id' => 15,
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Tonsuya Admin',
            'last_name' => 'Tonsuya Admin',
            'email' => 'tonsuya@gmail.com',
            'contact_no' => '0987654321',
            'gender' => 'M',
            'birth_date' => '1999-01-08',
            'address' => '123 fake street',
            'barangay_id' => 20,
            'password' => Hash::make("Pass1234!"),
            'user_type_id' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
