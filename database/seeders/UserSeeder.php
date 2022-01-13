<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        // DB::table('barangays')->insert([
        //     [
        //         'description' => 'Acacia'
        //     ],
        //     [
        //         'description' => 'Baritan'
        //     ],
        //     [
        //         'description' => 'Bayan-Bayanan'
        //     ],
        //     [
        //         'description' => 'Catmon'
        //     ],
        //     [
        //         'description' => 'Concepcion'
        //     ],
        //     [
        //         'description' => 'Dampalit'
        //     ],
        //     [
        //         'description' => 'Flores'
        //     ],
        //     [
        //         'description' => 'Hulong Duhat'
        //     ],
        //     [
        //         'description' => 'Ibaba'
        //     ],
        //     [
        //         'description' => 'Longos'
        //     ],
        //     [
        //         'description' => 'Maysilo'
        //     ],
        //     [
        //         'description' => 'Muzon'
        //     ],
        //     [
        //         'description' => 'Niugan'
        //     ],
        //     [
        //         'description' => 'Panghulo'
        //     ],
        //     [
        //         'description' => 'Potrero'
        //     ],
        //     [
        //         'description' => 'San Agustin'
        //     ],
        //     [
        //         'description' => 'Santolan'
        //     ],
        //     [
        //         'description' => 'Tañong'
        //     ],
        //     [
        //         'description' => 'Tinajeros'
        //     ],
        //     [
        //         'description' => 'Tonsuya'
        //     ],
        //     [
        //         'description' => 'Tugatog'
        //     ]
        // ]);
    }
}
