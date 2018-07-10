<?php
/**
 * Created by PhpStorm.
 * User: SARAY
 * Date: 2/6/2018
 * Time: 10:00 AM
 */

namespace App\Http\Operators;
use App\Http\APIClients;
use Config;
use GuzzleHttp\Client;

class Operator
{
    private $baseClient;
    private $clientID;
    private $clientSecret;
    private $endPoint;
    private $redirectURI;
    public function __construct()
    {
        $this->baseClient = new APIClients\BaseClient();
        $this->clientID = env('FACEBOOK_ID');
        $this->clientSecret = env('FACEBOOK_SECRET');
        $this->endPoint = env('FACEBOOK_END_POINT');
        $this->redirectURI = env('FACEBOOK_REDIRECT_URI');
    }

    /**
     * Get base client
     * @return APIClients\BaseClient
     */
    public function getBaseClient(){
        return $this->baseClient;
    }

    /**
     * Get fb Client ID
     * @return fb_client_id
     */
    public function getFBClientID(){
       return $this->clientID;
    }

    /**
     * Get fb Client Secret
     * @return mixed
     */
    public function getFBClientSecret(){
        return $this->clientSecret;
    }

    /**
     * Get fb endpoint
     * @return mixed
     */
    public function getFBEndPoint(){
        return $this->endPoint;
    }

    /**
     * Get fb redirect URI
     * @return mixed
     */
    public function getFBRedirectURI(){
        return $this->redirectURI;
    }
}