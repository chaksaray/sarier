<?php
namespace App\Http\Operators;
/**
 * Created by PhpStorm.
 * User: SARAY
 * Date: 1/29/2018
 * Time: 12:12 PM
 */
class FBPageOperator extends Operator
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get facebook access token
     * @param $code
     * @return mixed
     */
    public function getFBAcessToken($code){
        $canvas_page_url = urlencode(parent::getFBRedirectURI());
        $requestURL = parent::getFBEndPoint()."/oauth/access_token?client_id=".parent::getFBClientID()."&redirect_uri="
            .$canvas_page_url."&client_secret=".parent::getFBClientSecret()."&code=".$code."";
        $response = parent::getBaseClient()->getData($requestURL);
        $accessToken = $response["access_token"];
        return $accessToken;
    }

    /**
     * Get facebook auth pages
     * @param $accessToken
     * @return mixed
     */
    public function getFBPage($accessToken){
        $requestURL = parent::getFBEndPoint()."/me/accounts?access_token=".$accessToken."&fields=picture,id,name,access_token,username,perms,likes";
        $response = parent::getBaseClient()->getData($requestURL);
        return $response["data"];
    }

    /**
     * Get list of users who interacted with a page
     * @param $pageId
     * @param $pageAccessToken
     */
    public function subscribePage($pageId, $pageAccessToken){
        $requestURL = parent::getFBEndPoint()."/".$pageId."/subscribed_apps?access_token=".$pageAccessToken."";
        $response = parent::getBaseClient()->postData($requestURL);
        return $response;
    }

    /**
     * Unsubscribe fb page
     * @param $pageId
     * @param $pageAccessToken
     * @return mixed
     */
    public function unSubscribePage($pageId, $pageAccessToken){
        $requestURL = parent::getFBEndPoint()."/".$pageId."/subscribed_apps?access_token=".$pageAccessToken."";
        $response = parent::getBaseClient()->postData($requestURL);
        return $response;
    }
}