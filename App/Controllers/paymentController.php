<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Payment\payment;
use App\Payment\strategyPaymentOnThePost;

class paymentController extends Controller{

    public function index()
    {

       
    }

    public function payonhome()
    {
        $payMethod = new strategyPaymentOnThePost();
        $pay = new payment($payMethod);
        $pay->pay('4222000');
        $detail_product = unserialize($_SESSION['cart']['checkoutedetail']);
        $data = [
            'datacheckout'=> $detail_product,
        ];
        
        views("payment.payonhome.index",$data);
    }
}