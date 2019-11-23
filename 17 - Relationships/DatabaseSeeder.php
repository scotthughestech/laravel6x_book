<?php

use Illuminate\Database\Seeder;
use App\Purchase;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create ten users
        factory(User::class, 10)->create();

        // Create 1000 purchases
        factory(Purchase::class, 1000)->create();
    }
}
