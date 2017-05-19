<?php

use Illuminate\Database\Seeder;

class BlockReasonsTableSeeder extends Seeder
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

        DB::table('block_reasons')->insert([
            'name' => 'Misbruik regels'
        ]);
        DB::table('block_reasons')->insert([
            'name' => 'Grof gedrag t.o.v. anderen'
        ]);
        DB::table('block_reasons')->insert([
            'name' => 'Plaatsing van offensieve klusjes'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
