<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
      $responses = DB::table('response_urls')
                  ->join('urls', 'urls.id', '=', 'response_urls.url_id')
                  ->select('response_urls.*', 'urls.link')
                  ->where('url_id', '=', $id)
                  ->get();

      return response()->json($responses);
    }
}
