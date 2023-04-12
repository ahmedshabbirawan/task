<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use App\Interfaces\BusinessRepositoryInterface;

class HomeController extends Controller
{

    private BusinessRepositoryInterface $businessRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BusinessRepositoryInterface $businessRepository){
        $this->businessRepository = $businessRepository;
        $this->middleware('auth')->except(['home']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    function home(){
        $business = $this->businessRepository->getAllBusinesses();
        return view('home.dashboard',['business' => $business]);
    }


}
