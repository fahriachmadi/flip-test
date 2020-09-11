<?php
namespace App\Util;

use GuzzleHttp\Client;

class FlipAPIService
{
  protected $client;
  protected $headers;

  public function __construct()
  {
    $this->client = new Client([
      'base_uri' => env('API_BASE_URL'),
    ]);

    $this->headers = [
      'Authorization' => 'Basic ' . env('SECRET_KEY'),        
    ];
  }

  public function getDisbursementStatus($id)
  {
    $res = $this->client->request('GET',  'disburse/'.$id, ['headers' => $this->headers]);

    $response = [
      'status' => $res->getStatusCode(),
      'body' => $res->getBody()
    ];
    
    return $response;
  }

  public function sendDisbursement($payload)
  {

    $res = $this->client->request('POST',  'disburse', [
      'headers' => $this->headers,
      'form_params' => $payload
    ]);
    
    $response = [
      'status' => $res->getStatusCode(),
      'body' => $res->getBody()
    ];
    dd($response);die();
    return $response;
  }

  public function response_handler($response)
	{
		if ($response) {
			return json_decode($response);
		}
		
		return [];
	}
}