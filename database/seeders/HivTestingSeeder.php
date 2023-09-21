<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HivTestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = DB::table('patients')
            ->select('id')
            ->get();

        $data_elements = DB::table('data_elements')
            ->select('id')
            ->get();

        foreach ($patients as $patient) {
            DB::table('hiv_testings')->insert([
                'patient_id' => $patient->id,
                'data_element_id' => ($data_elements->random())->id,
                'created_at' => fake()->dateTimeBetween('2023-04-01', '2023-08-31'),
            ]);
        }
    }
}
