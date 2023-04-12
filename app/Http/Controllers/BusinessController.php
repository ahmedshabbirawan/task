<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessFormRequest;
use App\Models\Business;
use App\Models\Product;
use Illuminate\Http\Request;


use Kreait\Firebase\Messaging\CloudMessage;
use App\Interfaces\BusinessRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Exception;

class BusinessController extends Controller{


    private BusinessRepositoryInterface $businessRepository;
    private ProductRepositoryInterface $productRepository;


    public function __construct(BusinessRepositoryInterface $businessRepository, ProductRepositoryInterface $productRepository)
    {
        $this->businessRepository = $businessRepository;
        $this->productRepository  = $productRepository;
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


        $obj = $this->businessRepository->createBusiness($input);

        if($obj instanceof Business){
            $request->session()->put('business_id',$obj->id);
            return redirect(route('businesses.detail', $obj->id));
        }elseif($obj instanceof Exception){
            return redirect(route('businesses.create'))
            ->with('error','Error comes please contact with site admin')
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
        $product  = $this->productRepository->getAllProducts(); 
        
        return view('business.detail',['business' => $business, 'products' => $product]);
    }



    

    
}
