<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceTokenFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Interfaces\UserRepositoryInterface;

use App\Util\AjaxResponse;


class UserController extends Controller{
    

    use AjaxResponse;

    private UserRepositoryInterface $userRepository;


    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
       
    }

    public function saveToken(DeviceTokenFormRequest $request){
        $deviceToken    = $request->get('device_token');
        $userID         = auth()->user()->id;
        
        $obj = $this->userRepository->updateUser($userID, ['device_token' => $deviceToken]);


        if($obj instanceof User){
            return $this->sendResponse($obj,'Token saved successfully.' );
        }else{
            return $this->sendError('Error.Please Contact Web Admin'. $obj, []);
        }

      
    }
  
    
}
