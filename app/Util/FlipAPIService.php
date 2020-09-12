<?php
namespace App\Util;

use GuzzleHttp\Client;

class FlipAPIService
{
  protected $client;
  protected $auth;

  public function __construct()
  {
    $this->client = new Client([
      'base_uri' => env('API_BASE_URL'),
    ]);

    $this->auth = [
        env('SECRET_KEY'),
        ''        
    ];
  }

  public function getDisbursementStatus($id)
  {
    $res = $this->client->request('GET',  'disburse/'.$id, ['auth' => $this->auth]);

    return $this->response_handler($res->getBody()->getContents());
  }

  public function sendDisbursement($payload)
  {

    $res = $this->client->request('POST',  'disburse', [
      'auth' => $this->auth,
      'form_params' => $payload
    ]);
    

    return $this->response_handler($res->getBody()->getContents());
  }

  public function response_handler($response)
	{
		if ($response) {
			return json_decode($response);
		}
		
		return [];
  }
}