<?php

namespace App\Models;

class CartModel{


    public function removeProductFromCart( ) : void
    {
        $cartDetails = $_SESSION['cart'];
        if(isset($_POST['removeProduct'])){
            $id = $_POST['removeProduct'];
            unset($cartDetails[$id]);
            $_SESSION['cart'] = $cartDetails;
            $redirect = site_url('proje/cart/');
            header("Location:$redirect");
        }
    }

    public function getSubTotalCart($id)
    {
        $cartDetails = $_SESSION['cart'];
        dd($cartDetails);
    }

    public function totalCart(): int
    {
        $totalPrice = 0;
        $cartDetails = $_SESSION['cart'];
        if(empty($cartDetails))
            return null;
        foreach($cartDetails as $key => $cartDetail){
            if(is_string($key)) continue;
           $totalPrice += str_replace(' تومان','',$cartDetail['subtotal']);

        }
        if(!is_int($totalPrice))
            return null;

        return $totalPrice;

    }

    public function ajaxQuantityCart(){
        // dd($_POST['inputvalue']);
        // echo json_encode($_POST['inputvalue']);
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {

            $id = isset($_POST['idproduct']) && !empty($_POST['idproduct']) ? $_POST['idproduct'] : null;
            $quantity = isset($_POST['inputvalue']) && !empty($_POST['inputvalue']) ? $_POST['inputvalue'] : null; 
            $newPrice = (int) $_SESSION['cart'][$id]['price'] * $quantity;

            $_SESSION['cart'][$id]['attributes']['quantity'] = $quantity;
            $_SESSION['cart'][$id]['subtotal'] = $newPrice;
            // dd($this->cartModel->totalCart());
            die(json_encode([
                'newPrice'   => $newPrice,
                'totalPrice' => $this->totalCart(),
            ],200));
        }
    }


}