<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessUrl;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
   /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
   */
   public function index()
   {
     ProcessUrl::dispatch(Auth::id());
   }

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
