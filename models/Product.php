<?php

class Product{
    private $id;
    private $category_id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $offer;
    private $date;
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
    public function getCategoryId(){
        return $this->category_id;
    }
    public function setCategoryId($category_id){
        $this->category_id = $category_id;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $this->db->real_escape_string($name);
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description = $this->db->real_escape_string($description);
    }
    public function getPrice(){
        return $this->price;
    }
    public function setPrice($price){
        $this->price = $this->db->real_escape_string($price);
    }
    public function getStock(){
        return $this->stock;
    }
    public function setStock($stock){
        $this->stock = $this->db->real_escape_string($stock);
    }
    public function getOffer(){
        return $this->offer;
    }
    public function setOffer($offer){
        $this->offer = $this->db->real_escape_string($offer);
    }
    public function getDate(){
        return $this->date;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function getImage(){
        return $this->image;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function getAll(){

        $sql = "SELECT * FROM products ORDER BY id DESC";
        $products = $this->db->query($sql);

        return $products;
    }
    public function getProduct(){

        $product =$this->db->query("SELECT * FROM products WHERE id = {$this->getId()}");

        return $product->fetch_object();
    }
    public function getProductRandom($limit){
        $products = $this->db->query("SELECT * FROM products ORDER BY RAND() LIMIT $limit");

        return $products;
    }
    public function getMemberComments(){
        $sql = "SELECT * FROM comments WHERE product_id = {$this->getId()} and member_id = {$this->getthisMemberId()} ";
   //echo $sql;exit;

        $Membercomment = $this->db->query($sql);
        return $Membercomment;
    }  
// public function getthisMemberId(){

//     $mem=$_SESSION['user_identity']->id;
//     return $mem;
// }   

public function getthisMemberId(){

    if($_SESSION['user_identity']->id)
    {
        $mem=$_SESSION['user_identity']->id;
        return $mem;
    }
    else{
        return 0;
    }
} 
//comments
public function setCommentName($mem_name){
    $this->mem_name = $this->db->real_escape_string($mem_name);
}
public function getCommentName(){
    return $this->mem_name;
}
public function setCommentDescription($comment_description){
    $this->comment_description = $this->db->real_escape_string($comment_description);
}
public function getCommentDescription(){
    return $this->comment_description;
}
public function setMemberid($member_id){
    $this->member_id = $this->db->real_escape_string($member_id);
}
public function getMemberid(){
    return $this->member_id;
}
public function setProductid($product_id){
    $this->product_id = $this->db->real_escape_string($product_id);
}
public function getProductid(){
    return $this->product_id;
}

public function getProductRate(){

    $comments =$this->db->query("SELECT AVG(comment_value) as comments_avg FROM comments WHERE product_id = {$this->getId()}");
   // if($comments->fetch_object()){ 
        while($comment = $comments->fetch_object()):
        $comments_avg= $comment->comments_avg;
        endwhile;
        return  $comments_avg;

   // }
}

public function getCommentvalue(){
    $commenttext= $this->getCommentDescription();
    $keywords=$this->getKeywords();
    $commentValue=0;
    $i=0;
    while($keyword = $keywords->fetch_object()):
        
        if (stristr($commenttext,$keyword->name)):
            $i++;
            $commentValue += $keyword->value;
        endif;    
    endwhile;
    if($i)$commentValue= $commentValue/$i;

    if ($commentValue > 10)$commentValue=10;
    if ($commentValue <0) $commentValue=0;
    return $commentValue;
}

public function getKeywords(){
    $sql = "SELECT * FROM keywords";

    $keywords = $this->db->query($sql);

    return $keywords;
}


    public function getProductCategory(){
        $sql = "SELECT p.*, c.name AS 'categoryname' FROM products p
                    INNER JOIN categories c ON c.id = p.category_id
                        WHERE p.category_id = {$this->getCategoryId()}
                            ORDER BY id DESC";

        $products = $this->db->query($sql);

        return $products;
    }
    public function save(){

        $sql = "INSERT INTO products
                    VALUES(NULL, {$this->getCategoryId()}, '{$this->getName()}', '{$this->getDescription()}', {$this->getPrice()}, {$this->getStock()}, NULL, CURDATE(), '{$this->getImage()}' );";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function edit(){
        $sql = "UPDATE products
                    SET name = '{$this->getName()}', description = '{$this->getDescription()}', price = {$this->getPrice()}, stock = {$this->getStock()}, category_id = {$this->getCategoryId()} ";

        if($this->getImage() != null){
            $sql .= ", image = '{$this->getImage()}'";
        }

        $sql .= " WHERE id = {$this->id};";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM products WHERE id = {$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }

        return $result;
    }

    public function saveComment(){
        $comment =$this->db->query("SELECT * FROM comments WHERE product_id = {$this->getProductid()} and member_id= {$this->getMemberid()}");
            if($comment->fetch_object()){  
                $date=date("Y-m-d H:i:s"); 
                $sql = "UPDATE comments
                    SET comment_description = '{$this->getCommentDescription()}',comment_date = '{$date}', member_name = '{$this->getCommentName()}', comment_value='{$this->getCommentvalue()}'
                        WHERE product_id = {$this->getProductid()} and member_id= {$this->getMemberid()};";
               //echo $sql;exit; 
                $save = $this->db->query($sql);

                $result = false;
                if($save){
                    $result = true;
                }
        
        }
        else{
                    $date=date("Y-m-d H:i:s");
                    $sql = "INSERT INTO comments
                    VALUES(NULL, '{$this->mem_name}',  '{$this->getCommentDescription()}','$date', {$this->getProductid()}, {$this->getMemberid()}, '{$this->getCommentvalue()}' );";
                        $save = $this->db->query($sql);

                        $result = false;
                        if($save){
                            $result = true;
                        }
        }  
        return $result;
    }

    // public function getComments(){
    //     $sql = "SELECT member_name,comment_description,comment_date from comments where product_id = {$this->getId()}";
    //     $comment = $this->db->query($sql);
        
    //     return $comment;
    // }


    public function getComments(){
        $sql = "SELECT * from comments where product_id = {$this->getId()}";
        $comment = $this->db->query($sql);

        return $comment;
    }
    
    

    public function deletecomment(){
        $sql = "DELETE FROM comments WHERE product_id = {$this->id} and  member_id= {$this->getthisMemberid()}";
        //echo $sql ;exit;
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }


    // public function saverate(){
    //     $commenttext= $this->getCommentDescription();
    //     $keywords=$this->getKeywords();
    //     $commentValue=0;
    //     $counter=0;
    //     while($keyword = $keywords->fetch_object()):
        
    //         if (stristr($commenttext,$keyword->name)):
    //             $counter++;
    //             $commentValue += $keyword->value;
    //         endif;    
    //     endwhile;

    //     $total_rate=$commentValue/$counter;
        
    //     if ($total_rate > 10) $total_rate=10;
    //     if ($total_rate <0) $total_rate=0;
    //     return $total_rate;
    //     }


        // public function rateCommentvalue(){
        //     $sql="INSERT INTO rating values(NULL,{$this->getId()},{$this->getMemberid()},{$this->saverate()})";
        //     $rate = $this->db->query($sql);
        //     $result = false;
        //     if($rate){
        //         $result = true;
        //     }
        //     return $result;
        // }

}



?>