<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('location')->insert(array(
            array(
                'name' => "Chennai",
            ),
            array(
                'name' => "Coimbatore",
            ),
            array(
                'name' => "Virudhunagar",
            ),
            array(
                'name' => "Madurai",
            ),
            array(
                'name' => "Sivakasi",
            ),
            array(
                'name' => "Tenkasi",
            ),
            array(
                'name' => "Ooty",
            ),
            array(
                'name' => "Kodaikanal",
            ),
            array(
                'name' => "Vellore",
            ),
            array(
                'name' => "Tiruchi",
            ),
        ));
    }
}
