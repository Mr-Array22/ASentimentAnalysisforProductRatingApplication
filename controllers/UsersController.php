<?php

require_once 'models/User.php';

class UsersController{

    public function index(){

        Helpers::isAdmin();

        $user = new User();
        $users = $user->getAll();

        require_once 'views/users/index.php';
    }

    public function register(){
        require_once 'views/users/register.php';
    }

    public function save(){
        if(isset($_POST)){
            
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            
            if($name && $lastname && $email && $password){
                $user = new User();
                $user->setName($name);
                $user->setLastname($lastname);
                $user->setEmail($email);
                $user->setPassword($password);
                $save = $user->save();
                // var_dump($user);


                if($save){
                    $_SESSION['register'] = "completed";
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }

        }else{
            $_SESSION['register'] = "failed";
        }

        header("Location:".base_url."users/register");
    }

    public function login(){
        
        if(isset($_POST)){
            
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user_identity = $user->login();
            if($user_identity && is_object($user_identity)){

                
                $_SESSION['user_identity'] = $user_identity;

                
                if($user_identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }

            }else{
                $_SESSION['error_login'] = 'Login failed';
            }
        }

        header("Location:".base_url);
    }

    public function logout(){
        

        // if(isset($_SESSION['user_identity'])){
        //     unset($_SESSION['user_identity']);
        // }
        // if(isset($_SESSION['admin'])){
        //     unset($_SESSION['admin']);
        // }
        session_unset();
        session_destroy();
        header("Location:".base_url);
    }

  

    public function edit(){
        Helpers::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $user = new User();
            $user->setId($id);
            $userOne = $user->getuser();
            require_once 'views/users/create.php';
        }else{
            header("Location:".base_url."users/index");
        }
    }

    public function delete(){
        Helpers::isAdmin();

        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $user = new User();
            $user->setId($id);
            $delete = $user->delete();

            if($delete){
                $_SESSION['delete'] = "completed";
            }else{
                $_SESSION['delete'] = "failed";
            }
        }else{
            $_SESSION['delete'] = "failed";
        }

        header("Location:".base_url."users/index");
    }
    
}


?>