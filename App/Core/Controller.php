<?php
namespace App\Core;

use App\Models\attrModel;
use App\Models\CartModel;
use App\Models\checkouteModel;
use App\Models\couponModel;
use App\Models\imageModel;
use App\Models\imgsliderModel;
use App\Models\productModel;

class Controller{

    protected $request;
    protected $sliderImage;
    protected $imageModel;
    protected $productModel;
    protected $attrModel;
    protected $couponModel;
    protected $cartModel;
    protected $checkouteModel;

    public function __construct() {

        $this->request = new Request();
        $this->sliderImage = new imgsliderModel();
        $this->imageModel = new imageModel();
        $this->productModel = new productModel();
        $this->attrModel = new attrModel();
        $this->couponModel = new couponModel();
        $this->cartModel = new CartModel();
        $this->checkouteModel = new checkouteModel();

    }

}