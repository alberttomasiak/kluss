<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        // $this->call(klussSeeder::class);
        $this->call(BlockReasonsTableSeeder::class);
        $this->call(GlobalSettingsTableSeeder::class);
        $this->call(KlussCategoryTableSeeder::class);
    }
}
