<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();


        // Admin
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@kluss.be',
            'password' => bcrypt('klussadmin'),
            'account_type' => 'admin',
        ]);

        // Tom
        DB::table('users')->insert([
            'name' => 'Albert Tomasiak',
            'email' => 'tomasiakalbert@gmail.com',
            'password' => bcrypt('BlessUp'),
            'account_type' => 'admin',
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
