<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceTokenFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller{
    


    public function saveToken(DeviceTokenFormRequest $request){
        $deviceToken    = $request->get('device_token');
        $userID         = auth()->user()->id;
        try{
            DB::beginTransaction();
                User::updateUserDeviceToken($userID, $deviceToken);
            DB::commit();
            return response()->json([ 'status' => true, 'message' => 'token saved successfully.']);
        }catch(\Exception $e){
            return response()->json([ 'status' => false, 'message' => 'Error : '.$e->getMessage().'. Please Contact Web Admin']);
        }
    }
  
    
}
