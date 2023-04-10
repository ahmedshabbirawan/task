<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessFormRequest;
use App\Models\Business;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Kreait\Firebase\Messaging\CloudMessage;
use App\Interfaces\BusinessRepositoryInterface;



class BusinessController extends Controller{


    private BusinessRepositoryInterface $businessRepository;

    public function __construct(BusinessRepositoryInterface $businessRepository)
    {
        $this->businessRepository = $businessRepository;
    }
    

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
            $business = $this->businessRepository->createBusiness($input);
            DB::commit();
            $request->session()->put('business_id',$business->id);
            return redirect(route('businesses.detail', $business->id));

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
        
        $business = $this->businessRepository->getBusinessById($id);
        $product  = Product::all(); 
        
        return view('business.detail',['business' => $business, 'products' => $product]);
    }



    

    
}
