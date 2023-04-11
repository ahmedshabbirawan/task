<?php

namespace App\Http\Controllers;


use App\Http\Requests\CustomerOrderFormRequest;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use App\Interfaces\CustomerOrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CustomerOrderResource;

use App\Util\AjaxResponse;

class CustomerOrderController extends Controller{

    use AjaxResponse;

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
               $data =  $this->customerOrderRepository->createCustomerOrder($data);
            DB::commit();

            return $this->sendResponse($data,'Place Order succssfully!' );

        }catch(\Exception $e){
            DB::rollBack();
            return $this->sendError('Error.Please Contact Web Admin', $e->getMessage());
        }
    }

    function get_customer_orders(Request $request){

        $responseType               = $request->get('res');
        $where['customer_id']       = auth()->user()->id;
        $orders                     = $this->customerOrderRepository->getCustomerOrderByWhere($where);

        if($responseType == 'html'){
            return view('business.sub_views.customer_side_orders',[ 'orders' => $orders ]);
        }else{
            return $this->sendResponse(  CustomerOrderResource::collection($orders)  , count($orders).' Orders' );
        }
    }

    function get_business_order(Request $request){

        $responseType             = $request->get('res');
        $where['business_id']     = $request->session()->get('business_id');

        $orders                   = $this->customerOrderRepository->getCustomerOrderByWhere($where);

        if($responseType == 'html'){
            return view('business.sub_views.owner_side_orders',[ 'orders' => $orders ]);
        }else{
            return $this->sendResponse(CustomerOrderResource::collection($orders), count($orders).' Orders' );
        }
    }


    function disatch_order(Request $request){
        $orderID    = $request->get('order_id');
        try{
            DB::beginTransaction();
                    $data = $this->customerOrderRepository->dispatchCustomerOrder($orderID,[]);
            DB::commit();
            return $this->sendResponse($data, count($data).' Orders' );
        }catch(\Exception $e){
            DB::rollBack();
            return $this->sendError('Error.Please Contact Web Admin', $e->getMessage());
        }


    }


    function by_customer(){
        return view('orders.by_customer',['business' => [], 'products' => []]);
    }
    
}
