<?php

class Keyword{
    private $id;
    private $name;
    private $value;
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
    public function getValue(){
        return $this->value;
    }
    public function setName($name){
        $this->name = $this->db->real_escape_string($name);
    }
    public function setValue($value){
        $this->value = $this->db->real_escape_string($value);
    }
    public function save(){

        $sql = "INSERT INTO keywords VALUES(NULL, '{$this->getName()}','{$this->getValue()}')";
//echo $sql;exit;
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }
    Public function getAll(){
        $sql = "SELECT * FROM keywords ORDER BY value DESC";

        $keywords = $this->db->query($sql);

        return $keywords;
    }
    public function getKeyword(){
        $sql = "SELECT * FROM keywords WHERE id = {$this->getId()}";

        $keyword = $this->db->query($sql);

        return $keyword->fetch_object();
    }

    public function edit(){
        $sql = "UPDATE keywords
                    SET name = '{$this->getName()}', value = '{$this->getValue()}'";

       

        $sql .= " WHERE id = {$this->id};";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM keywords WHERE id = {$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }

        return $result;
    }
  
}

?>