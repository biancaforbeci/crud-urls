<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\ResponseUrl;
use App\Models\Url;
use GuzzleHttp\Client;

class UrlsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'urls:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all urls and save http response e status code';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $urls = Url::all();
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
