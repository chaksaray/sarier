<?php
namespace App\Http\Models;
/**
 * Created by PhpStorm.
 * User: SARAY
 * Date: 2/7/2018
 * Time: 4:59 PM
 */
use App\Http\Models\Model;
use Illuminate\Support\Facades\DB;
class PlatformModel extends Model
{

    private $platform;
    public function __construct()
    {
        $this->platform = DB::table('platform');
    }

    public function listApp(){
        return $this->platform->get();
    }

    public function insert($data){

        $platformExist = $this->platform->where('user_id', '=', $data['user_id']) ->get();
        if(count($platformExist) > 0){
            return $platformExist;
        }else{
            return $this->platform->insert($data);
        }
    }

    public function update(){

    }

    public function delete(){

    }
}