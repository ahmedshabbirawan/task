<?php 
namespace App\Repositories;

use App\Interfaces\CustomerOrderRepositoryInterface;
use App\Models\CustomerOrder;


class CustomerOrderRepository implements CustomerOrderRepositoryInterface
{

  


    public function getAllCustomerOrder()
    {
        return CustomerOrder::all();
    }
    public function getCustomerOrderById($customerOrderId)
    {
        return CustomerOrder::findOrFail($customerOrderId);
    }
    public function getCustomerOrderByWhere(array $where){
        return CustomerOrder::getBusinessOrderByWhere($where);
    }

    public function dispatchCustomerOrder($orderId, array $details){
        return CustomerOrder::dispatchOrder($orderId);
    }


  
    public function createCustomerOrder(array $customerOrderDetails)
    {
        $customerOrderDetails['order_time'] = date('Y-m-d H:i:s');
        return CustomerOrder::create($customerOrderDetails);
    }


    /*
    public function updateCustomerOrder($customerOrderId, array $newDetails)
    {
        return CustomerOrder::whereId($customerOrderId)->update($newDetails);
    }

    public function deleteCustomerOrder($customerOrderId)
    {
        CustomerOrder::destroy($customerOrderId);
    }
    */
    
}


?>