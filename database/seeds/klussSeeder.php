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
            'title' => 'Afterparty cleanup',
            'description' => 'Oh man, het was een dik feestje gistere.. Maar ik heb mijn MVP presentatie straks!',
            'kluss_image' => '/img/klussjes/afterparty.jpg',
            'price' => '13',
            'date' => '2016-12-19 10:14:03',
            'address' => 'Zakstraat 12, Mechelen, België',
            'latitude' => '51.027692',
            'longitude' => '4.482575',
            'user_id' => '1'
        ]);

        DB::table('kluss')->insert([
            'title' => 'Help! Er is een rommelbom ontploft!',
            'description' => 'Tjonge jonge, al die deadlines, ik heb alles een beetje uit het oog verloren. Ik zoek dringend hulp met het opruimen van al dat rommel!',
            'kluss_image' => '/img/klussjes/rommelbom.jpg',
            'price' => '25',
            'date' => '2016-12-19 10:15:16',
            'address' => 'Lekkernijstraatje 14, Mechelen, België',
            'latitude' => '51.024497',
            'longitude' => '4.480800',
            'user_id' => '1'
        ]);

        DB::table('kluss')->insert([
            'title' => 'Vooral dweilen',
            'description' => 'Niet zo veel te doen, een uurtje max.',
            'kluss_image' => '/img/klussjes/dweilen.jpg',
            'price' => '11',
            'date' => '2016-12-19 10:16:14',
            'address' => 'Begijnenstraat 11, Mechelen, België',
            'latitude' => '51.028011',
            'longitude' => '4.477874',
            'user_id' => '1'
        ]);

        DB::table('kluss')->insert([
            'title' => 'Kerstboompje versieren!',
            'description' => 'We moeten pitchen en hebben niet echt tijd om het zelf te doen. Maar de eerste twee inschrijvers per klas krijgen een cadeautje!',
            'kluss_image' => '/img/klussjes/kerstboompje.jpg',
            'price' => '2',
            'date' => '2016-12-22 09:00:00',
            'address' => 'Kruidtuin, Blok G',
            'latitude' => '51.024678',
            'longitude' => '4.484660',
            'user_id' => '2'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
