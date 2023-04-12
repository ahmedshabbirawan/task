<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\OrderDispatch;
use Illuminate\Support\Facades\DB;


class CustomerOrder extends Model
{
    use HasFactory;

    public $orderDispatchPush = false;

   

    protected $fillable = [
        'product_id', 'customer_id', 'business_id','order_time','dispatch_time','arrived_time'
    ];

    

    static function createOrder($data){
        try{
            DB::beginTransaction();
                $data['order_time'] = date('Y-m-d H:i:s');
                $obj =  self::create($data);
            DB::commit();
            return $obj;
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    // static function getCustomerOrderByID($customerID){
    //     return CustomerOrder::with(['business','product'])->where('customer_id' , $customerID)->orderBy('id','DESC')->get();
    // }


    // static function getBusinessOrderByID($businessID){
    //     return CustomerOrder::with(['business','product','customer'])->where('business_id' , $businessID)->orderBy('id','DESC')->get();
    // }

    static function getBusinessOrderByWhere($where){
        return CustomerOrder::with(['business','product','customer'])->where($where)->orderBy('id','DESC')->get();
    }

    static function dispatchOrder($orderID){
        try{
            DB::beginTransaction();
                $order = CustomerOrder::find($orderID);
                $order->dispatch_time = date('Y-m-d H:i:s');
                $order->save();
            DB::commit();
            $event                      =   OrderDispatch::dispatch($order);
            $order->orderDispatchPush   =   ( isset($event[0]) )?$event[0]:false; 
            return $order;
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }



    function customer(){
        return $this->belongsTo(User::class,'customer_id');
    }

    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    function business(){
        return $this->belongsTo(Business::class,'business_id');
    }








}
