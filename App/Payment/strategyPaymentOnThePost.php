<?php
namespace App\Payment;

use App\Models\checkouteModel;
use App\Payment\Contracts\strategyinterfacePayment;

class strategyPaymentOnThePost implements strategyinterfacePayment{

    public function pay($amount){
        $checkout = new checkouteModel();
        // dd($checkout->getByColumn(['item_order'],[
        //     'session_id[=]' => session_id(),
        // ]));
       
        echo "$amount on the post is okay";
    }
}