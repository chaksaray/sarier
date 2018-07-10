<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $table = 'pages';
    protected $fillable = [
        'page_id', 'access_token','name', 'like_number', 'follower_number', 'cover_img', 'app_img','status'
    ];
    public function insertData($data){
        $pages = Page::where('page_id', $data[0]['page_id'])->first();
        if ($pages) {
            return $pages;
        }
        return Page::insert($data);
    }
}
