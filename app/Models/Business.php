<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Business extends Model
{
    use HasFactory;

    protected $fillable = ['name','info','address','lat','lng','user_id','created_at','updated_at']; 


    static function saveBusiness($data){

        try{
            DB::beginTransaction();
            $obj = self::create($data);
            DB::commit();
            return $obj;
        }catch(\Exception $e){
            DB::rollBack();
            return $e;
        }
        

        
    }


}
