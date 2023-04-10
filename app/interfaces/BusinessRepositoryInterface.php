<?php 

namespace App\Interfaces;

interface BusinessRepositoryInterface
{
    public function getAllBusinesses();
    public function getBusinessById($businessId);
    public function deleteBusiness($businessId);
    public function createBusiness(array $businessDetails);
    public function updateBusiness($taskId, array $newDetails);
}

?>