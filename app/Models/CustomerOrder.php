<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\OrderDispatch;



class CustomerOrder extends Model
{
    use HasFactory;

   

    protected $fillable = [
        'product_id', 'customer_id', 'business_id','order_time','dispatch_time','arrived_time'
    ];

    

    // static function createOrder($data){
    //     $data['order_time'] = date('Y-m-d H:i:s');
    //     return CustomerOrder::create($data);
    // }

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
        $order = CustomerOrder::find($orderID);
        $order->dispatch_time = date('Y-m-d H:i:s');
        $order->save();
    
        $event =    OrderDispatch::dispatch($order);

        $eventStatus = (isset($event[0]) && $event[0] == true )?true:false; 

        return ['order' => $order, 'event' => $eventStatus  ];
        // (isset($event[0]))?$event[0]:$event
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
