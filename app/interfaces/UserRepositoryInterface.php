<?php 

namespace App\Interfaces;

interface UserRepositoryInterface{
    
    public function updateUser($taskId, array $newDetails);

}

?>