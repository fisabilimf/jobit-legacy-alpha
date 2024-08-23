<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    public static function insertData($data){

        $value=DB::table('jobs')->where('user_id', $data['user_id'])->get();
        if($value->count() >= 0){
           DB::table('jobs')->insert($data);
        }
     }
}
