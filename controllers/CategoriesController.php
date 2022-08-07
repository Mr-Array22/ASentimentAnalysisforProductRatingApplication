<?php
require_once 'models/Category.php';
require_once 'models/Product.php';

class CategoriesController{

    public function index(){

        Helpers::isAdmin();

        $category = new Category();
        $categories = $category->getAll();

        require_once 'views/categories/index.php';
    }
    public function show(){

        if(isset($_GET['id'])){
            
            $id = $_GET['id'];

            
            $category = new Category();
            $category->setId($id);
            $category = $category->getCategory();

            
            $product = new Product();
            $product->setCategoryId($id);
            $products = $product->getProductCategory();
        }

        require_once 'views/categories/show.php';
    }

    public function create(){
        Helpers::isAdmin();

        require_once 'views/categories/create.php';
    }

    public function save(){

        Helpers::isAdmin();

        if(isset($_POST) && isset($_POST['name'])){

            $category = new Category();
            $category->setName($_POST['name']);
            
            if(isset($_GET['id'])){
                
                $id = $_GET['id'];
               
                $category->setId($id);

                $save = $category->edit();
            }else{
                $save = $category->save();
            }
           
            

        }
        header("Location:".base_url."categories/index");
    }
    public function edit(){
        Helpers::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $category = new Category();
            $category->setId($id);
            $categoryOne = $category->getcategory();
            require_once 'views/categories/create.php';
        }else{
            header("Location:".base_url."categories/index");
        }
    }

    public function delete(){
        Helpers::isAdmin();

        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $category = new Category();
            $category->setId($id);
            $delete = $category->delete();

            if($delete){
                $_SESSION['delete'] = "completed";
            }else{
                $_SESSION['delete'] = "failed";
            }
        }else{
            $_SESSION['delete'] = "failed";
        }

        header("Location:".base_url."categories/index");
    }
}


?>