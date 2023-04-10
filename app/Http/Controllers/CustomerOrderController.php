<?php

namespace App\Http\Controllers;


use App\Http\Requests\CustomerOrderFormRequest;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use App\Interfaces\CustomerOrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CustomerOrderController extends Controller{



    private CustomerOrderRepositoryInterface $customerOrderRepository;

    public function __construct(CustomerOrderRepositoryInterface $customerOrderRepository)
    {
        $this->customerOrderRepository = $customerOrderRepository;
    }



    function place_order(CustomerOrderFormRequest $request){


        $data                   = $request->only(['product_id', 'business_id']);
        $data['customer_id']    = auth()->user()->id;

        try{
            DB::beginTransaction();
                $this->customerOrderRepository->createCustomerOrder($data);
            DB::commit();
            return response()->json(['ststus' => true, 'message' => 'Place Order succssfully!']);

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message' => 'Error.Please Contact Web Admin'. $e->getMessage()], 500);
        }
    }

    function get_customer_orders(Request $request){

        $responseType               = $request->get('res');
        $where['customer_id']       = auth()->user()->id;
        $orders                     = $this->customerOrderRepository->getCustomerOrderByWhere($where);

        if($responseType == 'html'){
            return view('business.sub_views.customer_side_orders',[ 'orders' => $orders ]);
        }else{
            return response()->json(['ststus' => true, 'data' => $orders]);
        }
    }

    function get_business_order(Request $request){

        $responseType             = $request->get('res');
        $where['business_id']     = $request->session()->get('business_id');

        $orders                   = $this->customerOrderRepository->getCustomerOrderByWhere($where);

        if($responseType == 'html'){
            return view('business.sub_views.owner_side_orders',[ 'orders' => $orders ]);
        }else{
            return response()->json(['ststus' => true, 'data' => $orders]);
        }
    }


    function disatch_order(Request $request){
        $orderID    = $request->get('order_id');
        try{
            DB::beginTransaction();
                    $data = $this->customerOrderRepository->dispatchCustomerOrder($orderID,[]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Order Dispatch', 'data' => $data]);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Error.Please Contact Web Admin'. $e->getMessage()], 500);
        }


    }


    function by_customer(){
        return view('orders.by_customer',['business' => [], 'products' => []]);
    }
    
}
