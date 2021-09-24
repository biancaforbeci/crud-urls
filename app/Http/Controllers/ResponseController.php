<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Cache;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\ResponseUrl;
use App\Models\Url;
use GuzzleHttp\Client;

class ResponseController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $responses = Cache::get('responses');

      if (!$responses) {
        $responses = DB::table('response_urls')
                    ->join('urls', 'urls.id', '=', 'response_urls.url_id')
                    ->select('response_urls.*', 'urls.link')
                    ->where('url_id', '=', $id)
                    ->get();
        Cache::put('response', $responses, 1440);
      }

      return response()->json($responses);
    }
}
