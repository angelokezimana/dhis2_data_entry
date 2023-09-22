<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryOptionComboSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_option_combos')->insert([
            [
                'id' => 'YBhrfw1dP2J',
                'display_name' => '<15y',
            ], [
                'id' => 'u5fU9rr67xo',
                'display_name' => '15-24y',
            ], [
                'id' => 'LbkJRbDblhe',
                'display_name' => '25-49y',
            ], [
                'id' => 'z858fbdqWwF',
                'display_name' => '>49y',
            ],
        ]);
    }
}
