<?php
namespace App\Controllers;

use App\Core\Controller;

class couponController extends Controller{


    
    public function createCouponCode() : string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $couponcode = array(); 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 9; $i++) {
            $n = rand(0, $alphaLength);
            $couponcode[] = $alphabet[$n];
        }
        return implode($couponcode); 
    }

    public function createCoupon($name, $percentage, $expiretime)
    {

        $couponCode = $this->createCouponCode();
        $timeToExpire = $this->expireCoupon($expiretime);
        $data =  $this->couponModel->create([
            'couponname'   =>  $name,
            'couponcode'   => $couponCode,
            'percentage'   => $percentage,
            'coupontime'   => $expiretime,
            'exipredcoupon'   => $timeToExpire,
        ]);
        return $data;
    }

    public function expireCoupon($expiretime)
    {
        
       $created_at   =  date("Y-m-d");
       $timeExpired = date('Y-m-d', strtotime($created_at. ' +'.$expiretime.' days'));
       return $timeExpired;

    }



    public function processCheckCouponCode()
    {
        $result = [
            'status' => true
        ];
        
        if(isset($_POST['couponsend']) ){
            $couponCode = $_POST['couponcode'];

            if (empty($this->haveCouponCode($couponCode))) {
                echo 'کد تخفیف وجود ندارد';
                return $result = ['status'=>false];
            }
            if(!$this->isExpireCoupon($couponCode)){
                echo   'کد تخفیف شما منقضی شده است';
                return $result = ['status'=>false];
            }
            echo 'کدتخفیف شما اعمال شد';
            return $result = [
                'status' => true,
                'couponcode'     =>$couponCode
            ];


        }
    }

    public function calculateDiscount($code, $totalCart)
    {
        $data = $this->couponModel->getByColumn(['percentage'],['couponcode[=]'=>$code]);
        if(empty($data)){
            return false;
        }
        $percentage = (int) $data[0]['percentage'];

        $sellingprice = $totalCart - (($totalCart * $percentage)/100)  ;

        return $sellingprice;

    }

    public function haveCouponCode($code)
    {
        $data = $this->couponModel->getByColumn(['couponcode'],['couponcode[=]'=>$code]);
        return $data;
    }

    public function isExpireCoupon($code)
    {
        $msg = '';
        $data = $this->couponModel->getByColumn(['exipredcoupon'],['couponcode[=]'=>$code]);
        $nowDay   =  date("Y-m-d");
        if($nowDay != $data[0]['exipredcoupon'])
        {
            return false ;
        }
        return true  ;
    }


    

    


}