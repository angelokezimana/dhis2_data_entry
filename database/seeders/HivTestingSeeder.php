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
            ->select('id', 'dob')
            ->get();

        $data_elements = DB::table('data_elements')
            ->select('id')
            ->get();

        foreach ($patients as $patient) {
            $patient_dob = $patient->dob;

            $category_option_combo = DB::table('category_option_combos')
            ->select('id', 'display_name')
            ->whereRaw("CASE
            WHEN display_name = '<15y' AND TIMESTAMPDIFF(YEAR, ?, CURDATE()) < 15 THEN 1
            WHEN display_name = '15-24y' AND (TIMESTAMPDIFF(YEAR, ?, CURDATE()) BETWEEN 15 AND 24) THEN 1
            WHEN display_name = '25-49y' AND (TIMESTAMPDIFF(YEAR, ?, CURDATE()) BETWEEN 25 AND 49) THEN 1
            WHEN display_name = '>49y' AND TIMESTAMPDIFF(YEAR, ?, CURDATE()) > 49 THEN 1
            ELSE 0
        END = 1", [$patient_dob, $patient_dob, $patient_dob, $patient_dob])
            ->first();

            DB::table('hiv_testings')->insert([
                'patient_id' => $patient->id,
                'data_element_id' => ($data_elements->random())->id,
                'category_option_combo_id' => $category_option_combo->id,
                'created_at' => fake()->dateTimeBetween('2023-04-01', '2023-08-31'),
            ]);
        }
    }
}
