<?php
namespace App\Http\APIClients;
use GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: SARAY
 * Date: 1/29/2018
 * Time: 12:11 PM
 */
class BaseClient extends APIClient
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
                'headers'  => [
//                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ]
            ]);
    }

    /**
     * function to get data using GET method from api
     * @param $url
     * @return mixed
     */
    public function getData($url){
        $response = $this->client->get($url);
        return json_decode($response->getBody()->getContents(),true);
    }

    /**
     * function get data using POST method from api
     * @param $url
     * @return mixed
     */
    public function postData($url){
        $response = $this->client->post($url);
        return json_decode($response->getBody()->getContents(),true);
    }
}