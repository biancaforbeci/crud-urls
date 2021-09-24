<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;

class UrlSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
   */
  public function run()
  {
      DB::table('urls')->insert([
        'link' => 'https://www.google.com.br/',
        'description' => 'Google',
        'user_id' => 1,
      ]);
      DB::table('urls')->insert([
       'link' => 'https://httpstat.us/404',
       'description' => 'Exemplo',
       'user_id' => 2,
     ]);
  }
}
