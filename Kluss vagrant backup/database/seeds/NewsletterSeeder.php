<?php

use Illuminate\Database\Seeder;
use DB;

class NewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // fake data init
        $faker = Faker\Factory::create();
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //DB::table('users')->truncate();

        $emails = ['thomas.van.malderen@telenet.be', 'tomasiakalbert@gmail.com', 'rubenp.pauwels@gmail.com', 'stef.van.malderen@telenet.be', 'david.heerinckx@thomasmore.be'];

        for($i = 0; $i < count($emails); $i++){
            DB::table('newsletter_members')->insert([
                'email' => $emails[$i],
                'id' => $i+1,
            ]);
        }

        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
