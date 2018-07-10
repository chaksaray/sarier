<?php
namespace App\Http\Converters;

/**
 * Created by PhpStorm.
 * User: SARAY
 * Date: 2/7/2018
 * Time: 11:22 AM
 */
use Auth;
class FBPageConverter
{
    /**
     * Convert page data from fb api to and readable data
     * @param $rawPage
     * @return array
     */
    public function pageData($rawPage){
        $pages = array();
       if(count($rawPage) > 0){
           for ($i = 0; $i< count($rawPage); $i++){
               $aPage = [
                   'user_id' => Auth::id(),
                   'fb_page_id' => $rawPage[$i]['id'],
                   'name' => $rawPage[$i]['name'],
                   'access_token' => $rawPage[$i]['access_token'],
                   'app_img' => $rawPage[$i]['picture']['data']['url'],
                   'status' => 0
               ];
               array_push($pages,$aPage);
           }
       }
        return $pages;
    }
}