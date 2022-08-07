<?php

require_once 'models/Product.php';

class ProductsController{

    public function index(){
        $product = new Product();
        $products = $product->getProductRandom(6);

        require_once 'views/products/products.php';
    }

    public function show(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $product = new Product();
            $product->setId($id);
            $productOne = $product->getProduct();
            $commentOne = $product->getComments();
            $memberComment=$product->getMemberComments();
            $productRate=$product->getProductRate();       
        }

        require_once 'views/products/show.php';
    }

    public function manage(){
        Helpers::isAdmin();

        $product = new Product();
        $products = $product->getAll();
        require_once 'views/products/manage.php';
    }

    public function create(){
        Helpers::isAdmin();

        require_once 'views/products/create.php';
    }

    public function save(){
        Helpers::isAdmin();

        if(isset($_POST)){
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $description = isset($_POST['description']) ? $_POST['description'] : false;
            $price = isset($_POST['price']) ? $_POST['price'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $category = isset($_POST['category']) ? $_POST['category'] : false;
            // $image = isset($_POST['image']) ? $_POST['image'] : false;

            if($name && $description && $price && $stock && $category){

                $product = new Product();
                $product->setName($name);
                $product->setDescription($description);
                $product->setPrice($price);
                $product->setStock($stock);
                $product->setCategoryId($category);
                // $product->setImage($image);

            
                if(isset($_FILES['image'])){
                    $file = $_FILES['image'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    // var_dump($file);
                    // die();

                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                    
                        if(!is_dir('uploads/images')){

                            mkdir('uploads/images', 0777, true);
                        }

                        $product->setImage($filename);
                        
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                    }
                }

                //
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $product->setId($id);

                    $save = $product->edit();
                }else{
                    $save = $product->save();
                }

                if($save){
                    $_SESSION['product'] = "completed";
                }else{
                    $_SESSION['product'] = "failed";
                }
            }else{
                $_SESSION['product'] = "failed";
            }

        }else{
            $_SESSION['product'] = "failed";
        }
        header("Location:".base_url."products/manage");
    }

    public function edit(){
        Helpers::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $product = new Product();
            $product->setId($id);
            $productOne = $product->getProduct();
            require_once 'views/products/create.php';
        }else{
            header("Location:".base_url."products/manage");
        }
    }

    public function delete(){
        Helpers::isAdmin();

        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $product = new Product();
            $product->setId($id);
            $delete = $product->delete();

            if($delete){
                $_SESSION['delete'] = "completed";
            }else{
                $_SESSION['delete'] = "failed";
            }
        }else{
            $_SESSION['delete'] = "failed";
        }

        header("Location:".base_url."products/manage");
    }

    public function saveComment(){
        
        
        if(isset($_POST)){
            $mem_name = isset($_POST['mem_name']) ? $_POST['mem_name'] : false;
            $comment_description = isset($_POST['comment_description']) ? $_POST['comment_description'] : false;
            $member_id = isset($_POST['member_id']) ? $_POST['member_id'] : false;
            $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : false;
            

            if($mem_name && $comment_description && $member_id && $product_id){

                $comment = new Product();        
                $comment->setCommentName($mem_name);
                $comment->setCommentDescription($comment_description);
                $comment->setMemberid($member_id);
                $comment->setProductid($product_id);

                
                    $save = $comment->saveComment();
            

                    if($save){
                        $completed="Comment Added";
                    }else{
                        $completed ="No Comment Added";
                    }
                }else{
                    $completed ="No Comment Added";
                }
    
            }else{
                $completed ="No Comment Added";
            }
            header("Location:".base_url."products/show&id=".$product_id."&msg=".$completed);
    }

    // public function editcomment(){
    //     Helpers::isIdentiy();
    //     if(isset($_GET['id'])){
    //         $id = $_GET['id'];
    //         $edit = true;

    //         $comment = new Product();
    //         $comment->setId($id);
    //         $edit = $comment->getCommentDescription();
    //         require_once 'views/products/show.php';
    //     }else{
    //         header("Location:".base_url."products/show");
    //     }
    // }

            // public function rateCommentvalue(){
        //     $sql="INSERT INTO rating values(NULL,{$this->getId()},{$this->getMemberid()},{$this->saverate()})";
        //     $rate = $this->db->query($sql);
        //     $result = false;
        //     if($rate){
        //         $result = true;
        //     }
        //     return $result;
        // }
        

    public function deletecomment(){
        Helpers::isIdentiy();

        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $comment = new Product();
            $comment->setId($id);
            $delete = $comment->deletecomment();

            if($delete){
                $completed="Comment deleted";
            }else{
                $completed ="No Comment deleted";            }
        }else{
            $completed ="No Comment deleted";
        }

        header("Location:".base_url."products/show&id=".$id."&msg=".$completed);
        }



}


?>