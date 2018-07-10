<?php
/**
 * Created by PhpStorm.
 * User: SARAY
 * Date: 2/7/2018
 * Time: 5:04 PM
 */

namespace App\Http\Models;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Model;

class PageModel extends Model
{
    private $page;
    public function __construct()
    {
        $this->page = DB::table('pages');
    }

    public function listPage(){
        return $this->page->get();
    }

    /**
     * list pages by a singer user id
     * @param $userID
     * @return mixed
     */
    public function listPageByUser($userID){
        return $this->page->where('user_id', '=', $userID) ->get();
    }

    /**
     * Get a single page by pageID
     * @param $pageID
     * @return mixed
     */
    public function getPageByID($pageID){
        return $this->page->where('id', '=', $pageID) ->get();
    }

    /**
     * insert the multiple row data to data base
     * @param $data
     * @return mixed
     */
    public function insert($data){

        $pageExist = $this->page->where('fb_page_id', '=', $data[0]['fb_page_id']) ->get();
        if(count($pageExist) > 0){
           return $pageExist;
        }else{
           return $this->page->insert($data);
        }
    }

    public function update(){

    }

    public function delete(){

    }

}