<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = ['name','info','address','lat','lng','user_id','created_at','updated_at']; 


    static function saveBusiness($data){
        return self::create($data);
    }


}
