<?php

namespace App\Http\Controllers;


use App\Http\Requests\CustomerOrderFormRequest;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerOrderController extends Controller{

    function place_order(CustomerOrderFormRequest $request){


        $data                   = $request->only(['product_id', 'business_id']);
        $data['customer_id']    = auth()->user()->id;

        try{
            DB::beginTransaction();
                CustomerOrder::createOrder($data);
            DB::commit();
            return response()->json(['ststus' => true, 'message' => 'Place Order succssfully!']);

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message' => 'Error.Please Contact Web Admin'. $e->getMessage()], 500);
        }
    }

    function get_customer_orders(Request $request){

        $responseType   = $request->get('res');
        $customerID     = auth()->user()->id;
        $orders         = CustomerOrder::getCustomerOrderByID($customerID);

        if($responseType == 'html'){
            return view('business.sub_views.customer_side_orders',[ 'orders' => $orders ]);
        }else{
            return response()->json(['ststus' => true, 'data' => $orders]);
        }
    }

    function get_business_order(Request $request){

        $responseType   = $request->get('res');
        $businessID     = $request->session()->get('business_id');

        $orders = CustomerOrder::getBusinessOrderByID($businessID);

        if($responseType == 'html'){
            return view('business.sub_views.owner_side_orders',[ 'orders' => $orders ]);
        }else{
            return response()->json(['ststus' => true, 'data' => $orders]);
        }
    }


    function disatch_order(Request $request){
        $orderID    = $request->get('order_id');
        $data       = CustomerOrder::dispatchOrder($orderID);
        return response()->json(['status' => true, 'message' => 'Order Dispatch', 'data' => $data]);
    }


    function by_customer(){
        return view('orders.by_customer',['business' => [], 'products' => []]);
    }
    
}
