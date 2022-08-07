<?php

class Category{
    private $id;
    private $name;
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

    public function save(){

        $sql = "INSERT INTO categories VALUES(NULL, '{$this->getName()}')";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }
    Public function getAll(){
        $sql = "SELECT * FROM categories ORDER BY id DESC";

        $categories = $this->db->query($sql);

        return $categories;
    }
    public function getCategory(){
        $sql = "SELECT * FROM categories WHERE id = {$this->getId()}";

        $category = $this->db->query($sql);

        return $category->fetch_object();
    }

    public function edit(){
        $sql = "UPDATE categories SET name = '{$this->getName()}'";


        $sql .= " WHERE id = {$this->id};";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM categories WHERE id = {$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }

        return $result;
    }

}

?>