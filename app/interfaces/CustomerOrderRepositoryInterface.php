<?php 
namespace App\Interfaces;

interface CustomerOrderRepositoryInterface
{

   //  public function placeOrder();

    public function getAllCustomerOrder();
    public function getCustomerOrderById($customerOrderId);
    public function getCustomerOrderByWhere(array $where);
    public function createCustomerOrder(array $customerOrderDetails);
    public function dispatchCustomerOrder($orderId, array $details);

    /*
        public function deleteCustomerOrder($customerOrderId);
        public function updateCustomerOrder($orderId, array $newDetails);
    */

}

?>