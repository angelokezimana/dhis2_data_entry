<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_elements')->insert([
            [
                'id' => 'ZwrIPRUiHEB',
                'display_name' => 'HIV: currently on care',
                'data_set_id' => 'vc6nF5yZsPR',
            ], [
                'id' => 'veW7w0xDDOQ',
                'display_name' => 'HIV: new on care',
                'data_set_id' => 'vc6nF5yZsPR',
            ], [
                'id' => 'R4KStuS8qt7',
                'display_name' => 'HIV: testing',
                'data_set_id' => 'vc6nF5yZsPR',
            ], [
                'id' => 'o0fOD1HLuv8',
                'display_name' => 'HIV: counseling',
                'data_set_id' => 'vc6nF5yZsPR',
            ],
        ]);
    }
}
