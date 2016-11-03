<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            ['name' => 'site_name', 'value' => 'ScoCMF内容管理框架'],
            ['name' => 'icp_number', 'value' => ''],
            ['name' => 'statistics_code', 'value' => ''],
        ]);
    }
}
