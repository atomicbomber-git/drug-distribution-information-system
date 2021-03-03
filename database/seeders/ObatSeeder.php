<?php

namespace Database\Seeders;

use Database\Factories\ObatFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        ObatFactory::new()
            ->count(100)
            ->create();

        DB::commit();
    }
}
