<?php
namespace App\Controllers;

use App\Core\Controller;

class cartController extends Controller{

    public function index()
    {
        $discount = 0;
        $Coupon     = new couponController();
        $couponCode = $Coupon->processCheckCouponCode();

        if (isset($couponCode)) {
            if ($couponCode['status'] == true) {
                $discount   =  $Coupon->calculateDiscount($couponCode['couponcode'], $this->cartModel->totalCart());
            }
        }

        // $this->cartModel->getSubTotalCart();
                

        if(empty($_SESSION['cart'])){
            views('cart.emptyCart');
        }

        $data = [
            'cartDetail' => $_SESSION['cart'],
            'cartTotal'  => $this->cartModel->totalCart(),
            'discount' =>$discount
        ];
        
        $this->cartModel->removeProductFromCart();
        $this->cartModel->ajaxQuantityCart();

        views('cart.index',$data);


    }


   
}