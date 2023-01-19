<?php
namespace App\Payment;

use App\Payment\Contracts\strategyinterfacePayment;

class payment {

    private $paymentMethod;
    public function __construct(strategyinterfacePayment $paymentMethod){
        $this->setPaymentMethod($paymentMethod);
    }

    public function setPaymentMethod($paymentMethod){
        return $this->paymentMethod = $paymentMethod;
    }

    public function pay($amount){
        
        $this->paymentMethod->pay($amount);
    }
    
}