<?php
require_once 'models/Product.php';
class CartController{

    public function index(){
        
        if(isset($_SESSION['cart']) && count($_SESSION['cart']) >= 1){
            $cart = $_SESSION['cart'];
        }else{
            $cart = array();
        }
        require_once 'views/cart/index.php';
    }

    public function add(){

        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];
        } else {
            header('Location:'.base_url);
        }

        if (isset($_SESSION['cart'])) {
            
            $cont = 0;
            foreach($_SESSION['cart'] as $index => $element){
                if($element['id_product'] == $product_id){
                    $_SESSION['cart'][$index]['units']++;
                    $cont++;
                }
            }
        }

        
        if(!isset($cont) || $cont ==0) {
            
            $product = new Product();
            $product->setId($product_id);
            $productOne = $product->getProduct();

            if(is_object($productOne)){
                
                $_SESSION['cart'][] = array(
                    "id_product" => $productOne->id,
                    "price" => $productOne->price,
                    "units" => 1,
                    "product" => $productOne
                );
            }
        }

        header("Location:".base_url."cart/index");

    }

    
    public function delete(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            unset($_SESSION['cart'][$index]);
        }

        header("Location:".base_url."cart/index");
    }

    
    public function delete_all(){
        unset($_SESSION['cart']);
        header("Location:".base_url."cart/index");
    }

    
    public function up(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['cart'][$index]['units']++;
        }

        header("Location:".base_url."cart/index");
    }

    
    public function down(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['cart'][$index]['units']--;

            
            if($_SESSION['cart'][$index]['units'] == 0){
                unset($_SESSION['cart'][$index]);
            }
        }

        header("Location:".base_url."cart/index");
    }


}

?>