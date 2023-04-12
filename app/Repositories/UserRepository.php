<?php 
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserRepository implements UserRepositoryInterface
{
    public function updateUser($taskId, array $newDetails){
        
        return User::updateUserDeviceToken($taskId, $newDetails);
        
    }
    
}


?>