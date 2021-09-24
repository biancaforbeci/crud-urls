<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;

class ResponsesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('response_urls')->insert([
        'status_code' => 200,
        'response_http' => (string) utf8_encode("<!DOCTYPE html>
<html>
<head>
<title>Document</title>
</head>
<body>
TESTE
</body>
</html>"),
        'url_id' => 1
    ]);
    DB::table('response_urls')->insert([
      'status_code' => 404,
      'response_http' =>  (string) utf8_encode("<!DOCTYPE html>
<html>
<head>
<title>Document</title>
</head>
<body>
NOVO
</body>
</html>"),
      'url_id' => 2
    ]);
  }
}
