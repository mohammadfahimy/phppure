<?php
namespace App\Controllers;

use App\Core\Controller;

class homeController extends Controller{

    public function index()
    {
        $sliderData = $this->sliderImage->get("*");
        $imageData = $this->imageModel->get("*");
        $productData = $this->productModel->getByColumn(['image','price','title','pslug']);

        $data =[
            'sliderData'    => $sliderData,
            'imageData'     => $imageData,
            'productData'   => $productData,
        ];
        views("home.index",$data);
    }
}