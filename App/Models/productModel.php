<?php
namespace App\Models;
use App\Models\Contracts\mysqlBaseModel;

class productModel extends mysqlBaseModel{

    protected $table = 'product';


    //when created product 
    public function productSetSlug()
    {
        
        $productName = $this->getByColumn(['title']);
        foreach($productName as $product){

            $createSlug [] = str_replace(' ','-',$product['title']);
        }

        foreach( $createSlug as $slug){
            $this->create([
                'pslug' =>$slug
            ]);
        }

    }

    //get product by slug
    public function getProductBySlug(string $slug): array 
    {

        return array();
    }
}