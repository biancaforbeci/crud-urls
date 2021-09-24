<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\ResponseUrl;
use App\Models\Url;
use GuzzleHttp\Client;

class ProcessUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id)
    {
      $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $urls = DB::table('urls')->where('user_id', '=', $this->user_id)->get();
      $request = "";

      foreach ($urls as $key => $url) {

        $client = new Client();

        try {
            $request = $client->get($url->link);
            $this->saveResponseGuzzle($request, $url->id);
        } catch (\Exception $e) {
            $this->saveResponseGuzzle($e, $url->id, true);
        }
      }
    }

    private function saveResponseGuzzle($response, $url_id, $error = false)
    {
        try {
          $responseHttp = new ResponseUrl();
          $responseHttp->status_code = 500;

          if ($error) {
             $responseHttp->status_code = $response->getCode();
          }

          $responseHttp->response_http = "";

          if (!$error) {
              $responseHttp->response_http = json_encode($response->getBody()->getContents());
              $responseHttp->status_code = $response->getStatusCode();
              $responseHttp->html = base64_encode($response->getBody(true));
          }

          $responseHttp->url_id = $url_id;
          $responseHttp->save();
        } catch (\Exception $e) {
            return;
        }
    }
}
