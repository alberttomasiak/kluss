<?php

use Illuminate\Database\Seeder;

class GlobalSettingsTableSeeder extends Seeder
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
        DB::table('global_settings')->insert([
            'key'   => 'limit_starter',
            'value' => '2'
        ]);
        DB::table('global_settings')->insert([
            'key'   => 'limit_gold',
            'value' => '5'
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
