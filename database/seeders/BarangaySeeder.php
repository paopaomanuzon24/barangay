<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
}
