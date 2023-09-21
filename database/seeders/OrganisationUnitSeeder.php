<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganisationUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organisation_units')->insert([
            'id' => 'DiszpKrYNg8',
            'display_name' => 'Ngelehun CHC',
        ]);

        $user = DB::table('users')
            ->select('id')
            ->where('email', '=', 'kezangelo@gmail.com')
            ->first();

        DB::table('organisation_users')->insert([
            'user_id' => $user->id,
            'org_id' => 'DiszpKrYNg8',
        ]);
    }
}
