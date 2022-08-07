<?php
require_once 'models/Keyword.php';
//require_once 'models/Product.php';

class KeywordsController{

    public function index(){

        Helpers::isAdmin();

        $keyword = new Keyword();
        $keywords = $keyword->getAll();

        require_once 'views/keywords/index.php';
    }
    public function show(){

        if(isset($_GET['id'])){
            
            $id = $_GET['id'];

            
            $keyword = new Keyword();
            $keyword->setId($id);
            $keyword = $keyword->getKeyword();

        }

        
    }

    public function create(){
        Helpers::isAdmin();

        require_once 'views/keywords/create.php';
    }

    public function save(){

        Helpers::isAdmin();

        if(isset($_POST) && isset($_POST['name'])){

            $keyword = new Keyword();
            $keyword->setName($_POST['name']);
            $keyword->setValue($_POST['value']);
            if(isset($_GET['id'])){
                
                $id = $_GET['id'];
            
                $keyword->setId($id);

                $save = $keyword->edit();
            }else{
                $save = $keyword->save();
            }
        }
        header("Location:".base_url."keywords/index");
    }

    public function edit(){
        Helpers::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $keyword = new Keyword();
            $keyword->setId($id);
            $keywordOne = $keyword->getkeyword();
            require_once 'views/keywords/create.php';
        }else{
            header("Location:".base_url."keywords/index");
        }
    }

    public function delete(){
        Helpers::isAdmin();

        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $keyword = new Keyword();
            $keyword->setId($id);
            $delete = $keyword->delete();

            if($delete){
                $_SESSION['delete'] = "completed";
            }else{
                $_SESSION['delete'] = "failed";
            }
        }else{
            $_SESSION['delete'] = "failed";
        }

        header("Location:".base_url."keywords/index");
    }

}


?>