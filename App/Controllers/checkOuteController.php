<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Payment\payment;
use App\Payment\strategyPaymentOnThePost;

class checkOuteController extends Controller{

    public function index()
    {
        
        $data = [
            'detailsCart' => $_SESSION['cart'],
            'cartTotal'  => $this->cartModel->totalCart(),
        ];
        $this->getDetailsCheckoute();
        views('checkoute.index',$data);


    }

    public function getDetailsCheckoute()
    {

        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){

            $dataFileds = $_POST['fieldsValue'];
            $dataFileds['productname'] = $_POST['productName'];
            $dataFileds['country'] = $_POST['country'];
            $dataserialize = serialize($dataFileds);

            //check required fields()
            // dd($_POST['required']);
            if (isset($_POST['required'])) {
                $erros = $this->checkRequiredFields($_POST['required']);
                header("HTTP/1.1 400 Forbidden");
                die(json_encode(
                    [
                        'status' => false,
                        'msg' => $erros
                    ]
                    ));
            }
            // dd($_SESSION['cart']);
            // $this->checkouteModel->create([
            //     'item_order' =>$dataserialize,
            //     'session_id' =>session_id(),
            //     'payment_method'=>'paypal'
            // ]);
            // dd($_POST['required']);

            //check payment method ...
            // if method zarin pal bood ...
            //array_filter($linksArray)
            $_SESSION['cart']['checkoutedetail'] = $dataserialize;
            if($_POST['payonhome'] == 'on'){

                header("HTTP/1.1 200 okay");
                die(json_encode([
                    'status' => 'payonhome',
                    'route' => 'http://localhost/proje/payment/payonhome/',
                ]));
            }
            
           
        }
    }


    public function checkRequiredFields(array $data){

        $new_data = array_filter($data);
        $errors = [];
        foreach($new_data as $fields){
            
           $errors [] =  $this->showErrorFields($fields);
        }
        return $errors;
        
    }

    public function showErrorFields(string $field){

        $newField = str_replace('biling_','',$field);
        return "This Field ($newField) is Required";
    }



   
}