<?php
namespace App\Controllers;

use App\Core\Controller;

class productController extends Controller{

    private $detailProduct;
    public function index()
    {
        $productSlug = urldecode($this->request->productslug);
        
        $detailProduct =  $this->productModel->getByColumn(['title','price','score','description','attributes','image','stock','imgsslider','pslug','id'],['pslug[=]' =>$productSlug]);
        $this->detailProduct = $detailProduct;
        $productAttr = $this->getAttrProduct($detailProduct[0]['attributes']);
        $data = [
            'detailProduct' => $detailProduct,
            'productAttr'   => $productAttr,
        ];
        $this->setCartToSession();
        

        views('detail-product.index',$data);
     
    }


    public function getAttrProduct( string $id ) : array
    {   
        $ids = explode(',',$id);
        $attr = $this->attrModel->getByColumn(['name','amount'],['id'=>$ids]);
        $allAttr = [];
        foreach($attr as $key => $value){

            $exAmount = explode(',',$value['amount']);

            $allAttr[$value['name']] = $exAmount;
        }

        return $allAttr ;
    }

    public function getDetailProductCartAdded()
    {
        $result = [];
        if(isset($_POST['submitproduct'])){
            // dd($_POST['quantity'] * $this->detailProduct[0]['price']);
            $quantity = (int) $_POST['quantity'];
            $subTotal = $quantity * (int)$this->detailProduct[0]['price'];
            // $result [$this->detailProduct[0]['id']] = [
            //     'id'         => $this->detailProduct[0]['title'],
            //     'attributes' => $_POST,
            //     'price'      => $this->detailProduct[0]['price'],
            //     'image'      => $this->detailProduct[0]['image'],
            //     'subtotal'      => $subTotal,
                
    
            // ];
            $result [] = [
                $this->detailProduct[0]['id'] => [
                    'id'         => $this->detailProduct[0]['title'],
                    'attributes' => $_POST,
                    'price'      => $this->detailProduct[0]['price'],
                    'image'      => $this->detailProduct[0]['image'],
                    'subtotal'   => $subTotal,
                ],
                'checkoutedetail'=>''
            ];
        }
        
       return $result;
    }

    public function setCartToSession()
    {
        // unset($_SESSION['cart']);
        $detailPt = $this->getDetailProductCartAdded();
        if(empty($detailPt)){
            return;
        }

        if (!isset($_SESSION['cart'])) {

             $this->addToSession($detailPt);
               
        }
        $this->addToSession($detailPt);

    }

    public function addToSession(array $array) : array
    {

        foreach ($array as $key => $value) {
            foreach($value as $k => $val){

                if (is_int($k)) {
                     $_SESSION ['cart'][$k] = $val;
                }
                $_SESSION['cart'][$k] = $val;
            }

        }
        return $_SESSION['cart'];
    }
}