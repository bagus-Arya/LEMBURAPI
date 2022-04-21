<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ReferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('references')->insert([
            'code' => 'overtime_method',
            'name' => 28.901,
            'expression' => 231.213,
        ]);
        DB::table('references')->insert([
            'code' => 'overtime_method',
            'name' => 'Fixed',
            'expression' => 231.213,
        ]);
        DB::table('references')->insert([
            'code' => 'employee_status',
            'name' => 'Tetap',
        ]);
        DB::table('references')->insert([
            'code' => 'employee_status',
            'name' => 'Percobaan',
        ]);
    }
}
