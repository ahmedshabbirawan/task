<?php 
namespace App\Repositories;

use App\Interfaces\BusinessRepositoryInterface;
use App\Models\Business;
use Illuminate\Support\Facades\DB;


class BusinessRepository implements BusinessRepositoryInterface
{
    public function getAllBusinesses()
    {
        return Business::all();
    }
    public function getBusinessById($businessId)
    {
        return Business::findOrFail($businessId);
    }
    public function deleteBusiness($businessId)
    {
        Business::destroy($businessId);
    }
    public function createBusiness(array $businessDetails){
        return Business::saveBusiness($businessDetails);
    }
    public function updateBusiness($businessId, array $newDetails)
    {
        return Business::whereId($businessId)->update($newDetails);
    }
    
}


?>