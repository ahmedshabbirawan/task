<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessFormRequest;
use App\Models\Business;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Kreait\Firebase\Messaging\CloudMessage;



class BusinessController extends Controller{
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('business.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessFormRequest $request){


        $input              = $request->only(['name','info','address','lat','lng']);
        $input['user_id']   = auth()->user()->id;

        try{

            DB::beginTransaction();
            $businessID         = Business::saveBusiness($input);
            DB::commit();
            $request->session()->put('business_id',$businessID->id);
            return redirect(route('businesses.detail', $businessID));

        }catch(\Exception $e){
            DB::rollBack();
            return redirect(route('businesses.create'))
            ->with('error', 'Error : '.$e->getMessage().'. Please Contact Web Admin')
            ->withInput();
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $business = Business::findOrFail($id);
        $product  = Product::all(); 
        
        return view('business.detail',['business' => $business, 'products' => $product]);
    }



    function sendPush(){
        

$message = CloudMessage::withTarget(/* see sections below */)
    ->withNotification(Notification::create('Title', 'Body'))
    ->withData(['key' => 'value']);

$messaging->send($message);
    }

    
}
