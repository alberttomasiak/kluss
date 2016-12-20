<?php

use Illuminate\Database\Seeder;

class klussSeeder extends Seeder
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
        //DB::table('kluss')->truncate();

        DB::table('kluss')->insert([
            'title' => 'Dweilen, kuisen, stofzuigen',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'kluss_image' => 'img/klussjes/kluss-11482142443.jpg',
            'price' => '13',
            'date' => '2016-12-19 10:14:03',
            'address' => 'Antoon van Den Bosschelaan 76, Antwerpen, België',
            'latitude' => '51.22908440',
            'longitude' => '4.47425450',
            'user_id' => '1'
        ]);

        DB::table('kluss')->insert([
            'title' => 'Help! Er is een rommelbom ontploft!',
            'description' => 'Tjonge jonge, al die deadlines, ik heb alles een beetje uit het oog verloren. Ik zoek dringend hulp met het opruimen van al dat rommel!',
            'kluss_image' => 'img/klussjes/kluss-11482142516.jpg',
            'price' => '25',
            'date' => '2016-12-19 10:15:16',
            'address' => 'Lange Ridderstraat 14, Mechelen, België',
            'latitude' => '51.02497400',
            'longitude' => '4.48373410',
            'user_id' => '1'
        ]);

        DB::table('kluss')->insert([
            'title' => 'Vooral dweilen',
            'description' => 'Niet zo veel te doen, een uurtje max.',
            'kluss_image' => '/img/klussjes/geen-image.png',
            'price' => '11',
            'date' => '2016-12-19 10:16:14',
            'address' => 'Plantijnlei 44, Schoten, België',
            'latitude' => '51.24860440',
            'longitude' => '4.46509670',
            'user_id' => '1'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
