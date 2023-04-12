<?php

namespace App\Http\Controllers;


use App\Http\Requests\CustomerOrderFormRequest;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use App\Interfaces\CustomerOrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CustomerOrderResource;

use App\Util\AjaxResponse;
use Exception;

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
        $obj = $this->customerOrderRepository->createCustomerOrder($data);

        if($obj instanceof CustomerOrder){
            return $this->sendResponse($data,'Place Order succssfully!' );
        }elseif($obj instanceof Exception){
            return redirect(route('businesses.create'))
            ->with('error','Error comes please contact with site admin')
            ->withInput();
        } 



    }

    function get_customer_orders(CustomerOrderFormRequest $request){

        $responseType               = $request->get('res');
        $where['customer_id']       = auth()->user()->id;
        $orders                     = $this->customerOrderRepository->getCustomerOrderByWhere($where);

        if($responseType == 'html'){
            return view('business.sub_views.customer_side_orders',[ 'orders' => $orders ]);
        }else{
            return $this->sendResponse(  CustomerOrderResource::collection($orders)  , count($orders).' Orders' );
        }
    }

    function get_business_order(CustomerOrderFormRequest $request){

        $responseType             = $request->get('res');
        $where['business_id']     = $request->session()->get('business_id');

        $orders                   = $this->customerOrderRepository->getCustomerOrderByWhere($where);

        if($responseType == 'html'){
            return view('business.sub_views.owner_side_orders',[ 'orders' => $orders ]);
        }else{
            return $this->sendResponse(CustomerOrderResource::collection($orders), count($orders).' Orders' );
        }
    }


    function disatch_order(CustomerOrderFormRequest $request){
        
        $orderID    = $request->get('order_id');
        $obj        = $this->customerOrderRepository->dispatchCustomerOrder($orderID,[]);

        if($obj instanceof CustomerOrder){
            return $this->sendResponse($obj,'Place dispatch succssfully!' );
        }else{
      
            return $this->sendError('Error.Please Contact Web Admin'. $obj, []);
        } 

    }


    function by_customer(){
        return view('orders.by_customer',['business' => [], 'products' => []]);
    }
    
}
