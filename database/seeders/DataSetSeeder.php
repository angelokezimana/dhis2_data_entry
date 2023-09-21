<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_sets')->insert([
            'id' => 'vc6nF5yZsPR',
            'display_name' => 'HIV Care Monthly',
        ]);

        DB::table('data_set_organisation')->insert([
            'org_id' => 'DiszpKrYNg8',
            'data_set_id' => 'vc6nF5yZsPR',
        ]);
    }
}
