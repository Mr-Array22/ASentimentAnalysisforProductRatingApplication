<?php

require_once 'models/Order.php';

class OrdersController{

    
    public function do(){

        require_once 'views/orders/do.php';
    }

   
    public function add(){

        if(isset($_SESSION['user_identity'])){

            $user_id = $_SESSION['user_identity']->id;
            $state = isset($_POST['state']) ? $_POST['state'] : false;
            $city = isset($_POST['city']) ? $_POST['city'] : false;
            $adress = isset($_POST['adress']) ? $_POST['adress'] : false;

            $stats = Helpers::statsCart();
            $cost = $stats['total'];

            if($state && $city && $adress){
                
                $order = new Order();
                $order->setUserId($user_id);
                $order->setState($state);
                $order->setCity($city);
                $order->setAdress($adress);
                $order->setCost($cost);
                $save = $order->save();

                
                $save_line = $order->save_lines();

                if ($save && $save_line) {
                    $_SESSION['order'] = "completed";
                } else {
                    $_SESSION['order'] = "failed";
                }

            }else{
                $_SESSION['order'] = "failed";
            }

            header("Location:".base_url.'orders/confirm');

        }else{
            header("Location:".base_url);
        }
    }

    
    public function confirm(){
        if(isset($_SESSION['user_identity'])){
            $identity = $_SESSION['user_identity'];
            $order = new Order();
            $order->setUserId($identity->id);

            
            $order = $order->getOrderByUser();

            $order_products = new Order();
            $products = $order_products->getProductsByOrder($order->id);
        }

        require_once 'views/orders/confirm.php';
    }

    
    public function my_orders(){

        Helpers::isIdentiy();
        $user_id = $_SESSION['user_identity']->id;
        $order = new Order();

        
        $order->setUserId($user_id);
        $orders = $order->getOrdersByUser();

        require_once 'views/orders/my_orders.php';
    }

   
    public function detail(){
        Helpers::isIdentiy();
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            
            $order = new Order();
            $order->setId($id);
            $order = $order->getOrder();

            
            $order_products = new Order();
            $products = $order_products->getProductsByOrder($id);

            require_once 'views/orders/detail.php';
        }else{
            header("Location:".base_url.'orders/my_orders');
        }
    }

    
    public function manage(){
        Helpers::isAdmin();

        $manage = true;

        $order = new Order();
        $orders = $order->getAll();

        require_once 'views/orders/my_orders.php';
    }

    
    public function status(){
        Helpers::isAdmin();

        if(isset($_POST['order_id']) && isset($_POST['status'])){

            
            $id = $_POST['order_id'];
            $status = $_POST['status'];

            
            $order = new Order();
            $order->setId($id);
            $order->setStatus($status);
            $order->edit();

            header("Location:".base_url.'orders/detail&id='.$id);

        }else{
            header("Location:".base_url);
        }
    }
}

?>