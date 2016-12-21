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
            'name' => 'DJ Khaled',
            'email' => 'tomasiakalbert@gmail.com',
            'password' => bcrypt('ISecretlyLove50Cent'),
            'account_type' => 'admin',
            'bio' => 'Watch your back, but more importantly when you get out the shower, dry your back. It’s a cold world out there. Bless up! Another one!',
            'profile_pic' => '/img/dj-khaledicious.png'
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
