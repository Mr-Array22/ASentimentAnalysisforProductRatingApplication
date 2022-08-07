<?php

class User{
    private $id;
    private $name;
    private $lastname;
    private $email;
    private $password;
    private $rol;
    private $image;
    private $db;



    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $this->db->real_escape_string($name);
    }
    public function getLastname(){
        return $this->lastname;
    }
    public function setLastname($lastname){
        $this->lastname = $this->db->real_escape_string($lastname);
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }
    public function getPassword(){
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function getRol(){
        return $this->rol;
    }
    public function setRol($rol){
        $this->rol = $rol;
    }
    public function getImage(){
        return $this->image;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function save(){

        $sql = "INSERT INTO users
                    VALUES(NULL, '{$this->getName()}', '{$this->getLastname()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', NULL)";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }
    public function login(){
        


        $result = false;

        
        $email = $this->email;
        $password = $this->password;

        
        $sql = "SELECT * FROM users WHERE email = '$email'";
        
        $login = $this->db->query($sql);


        if($login && $login->num_rows == 1){
            
            $user = $login->fetch_object();

            $verify = password_verify($password, $user->password);
            
            if($verify){
                $result = $user;
            }
        }

        return $result;
    }

    public function edit(){
        $sql = "UPDATE users
                    SET name = '{$this->getName()}', lastname = '{$this->getLastname()}',email = '{$this->getEmail()}";
//echo $sql;exit;

        $sql .= " WHERE id = {$this->id};";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function delete(){
        $myid=$_SESSION['user_identity']->id;
        if($myid== $this->id) {
            $result = false;
        }
        else{
            $sql = "DELETE FROM users WHERE id = {$this->id}";
            $delete = $this->db->query($sql);

            $result = false;
            if($delete){
                $result = true;
            }
        }
        return $result;
    }

    Public function getAll(){
        $sql = "SELECT * FROM users ORDER BY id DESC";

        $users = $this->db->query($sql);

        return $users;
    }

    public function getUser(){
        $sql = "SELECT * FROM users WHERE id = {$this->getId()}";

        $user = $this->db->query($sql);

        return $user->fetch_object();
    }
}

?>