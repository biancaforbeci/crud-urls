<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Url;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(UsersSeeder::class);
      $this->call(UrlSeeder::class);
      $this->call(ResponsesSeeder::class);

      //Fake users and urls
      //User::factory(2)
      //        ->has(Url::factory()->count(3), 'urls')
      //        ->create();
    }
}
