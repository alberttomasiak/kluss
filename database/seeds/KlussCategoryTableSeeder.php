<?php

use Illuminate\Database\Seeder;

class KlussCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('kluss_categories')->insert([
            'name' => 'Tuinwerk'
        ]);

        DB::table('kluss_categories')->insert([
            'name' => 'Algemene huishoudhulp'
        ]);

        DB::table('kluss_categories')->insert(['name' => 'Overige']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
