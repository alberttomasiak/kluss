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
            'password' => bcrypt('Bn0WuoNbVpCQAWvA2#$7'),
            'account_type' => 'admin',
            'activated' => '1',
            'verified' => '1',
            'notifications_channel' => str_random(35),
        ]);

        // Onzen chat maaafk
        DB::table('users')->insert([
            'name' => 'Chat',
            'email' => 'chat@kluss.be',
            'password' => bcrypt('27p6mp9a2BOrAvSQ@enA'),
            'account_type' => 'admin',
            'verified' => '1',
            'blocked' => '0',
            'activated' => '1',
            'notifications_channel' => str_random(35),
        ]);

        // Den Albert eh ;)
        DB::table('users')->insert([
            'name' => 'DJ Khaled',
            'email' => 'tomasiakalbert@gmail.com',
            'password' => bcrypt('f03#FGLtKWFopS6A%!x2'),
            'account_type' => 'admin',
            'bio' => 'Watch your back, but more importantly when you get out the shower, dry your back. It’s a cold world out there. Bless up! Another one!',
            'profile_pic' => '/img/dj-khaledicious.png',
            'activated' => '1',
            'verified' => '1',
            'notifications_channel' => str_random(35),
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
