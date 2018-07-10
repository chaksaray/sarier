<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $table = 'platform';
    protected $fillable = [
        'user_id', 'page_id','plan_id', 'name'
    ];
}
