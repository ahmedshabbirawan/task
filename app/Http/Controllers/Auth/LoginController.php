<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\Business;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::AFTER_LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','after_login']);
    }


    function after_login(Request $request){
        //  echo auth()->user()->role; exit;
 
        $userID      = auth()->user()->id;
        $business    = Business::where('user_id',$userID)->first();
 
        if(isset($business->id)){
        // echo $business->id; exit;
            // session('business_id',$business->id);
             $request->session()->put('business_id',$business->id);
            // $request->session()->put('key', 'value');
        }
 
 
        return redirect(RouteServiceProvider::HOME);
     }


}
