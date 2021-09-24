<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Cache;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $urls = Cache::get('urls');

       if (!$urls) {
         $urls = DB::table('urls')->where('user_id', '=', Auth::id())->get();
         Cache::put('urls', $urls, 1440);
       }

       return response()->json($urls);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Url $url)
    {
      $request->validate([
        'link' => 'required|url',
        'description' => 'required'
      ]);

      $url->link = $request->link;
      $url->description = $request->description;
      $url->user_id = Auth::id();
      $url->save();

      $urls = Cache::get('urls');

      if ($urls) {
        Cache::tags('urls')->flush();
      }

      return response()->json([
          'message'=>'Url Added Successfully!!',
          'url'=>$url
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        return response()->json($url);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Url $url)
    {
      $url->fill($request->post())->save();
      return response()->json([
          'message'=>'Url Updated Successfully!!',
          'url'=>$url
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
      $url->delete();
      return response()->json([
          'message'=>'Url Deleted Successfully!!'
      ]);
    }
}
