<?php

namespace App\Listeners;

use App\Events\OrderDispatch;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\DB;

use App\Util\Fcm;

class SendOrderDispatchListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderDispatch  $event
     * @return void
     */
    public function handle(OrderDispatch $event){
       $order = $event->customerOrder;
       if( isset($order->customer_id)  ){
          $user =   User::find($order->customer_id);
          if($user->device_token != null){
                return Fcm::sendPush($user->device_token, 'Order Dispatch', 'Please visit the web app.');
          }
       }
    }
}
