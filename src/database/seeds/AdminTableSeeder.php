<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{

    public function run()
    {
        $this->call(ConfigsTableSeeder::class);
        $this->call(RbacTableSeeder::class);
    }
}