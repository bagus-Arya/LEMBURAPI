<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'key' => 'overtime_method',
            'value' => 1,
            'expression' => 231.213,
        ]);
    }
}
