<?php

use Illuminate\Database\Seeder;
use App\Purchase;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Purchase::class, 1000)->create();
    }
}
