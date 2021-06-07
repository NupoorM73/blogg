<?php
Class Comment {
 private $conn;
 public $table_name ="comments";
 
 //object properties
 public $email;
 public $comment_id;
 public $comment_body;
 public $post_id;
 public $created_at;
 public $updated_at;
 public $liveflag;

public function __construct($db){
        $this->conn = $db;
}
function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    email=:email,comment_id=:comment_id,comment_body=:comment_body,post_id=:post_id,created_at=:created_at,updated_at=:updated_at, liveflag = 0";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->comment_id=htmlspecialchars(strip_tags($this->comment_id));
        $this->comment_body=htmlspecialchars(strip_tags($this->comment_body));
        $this->post_id=htmlspecialchars(strip_tags($this->post_id));
        $this->created_at=htmlspecialchars(strip_tags($this->created_at));
        $this->updated_at=htmlspecialchars(strip_tags($this->updated_at));

        $this->created=date('Y-m-d');

       
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d');
 
        // bind values 
        $stmt->bindParam(":email",$this->email );
        $stmt->bindParam(":comment_id", $this->comment_id);
        $stmt->bindParam(":comment_body", $this->comment_body);
        $stmt->bindParam(":post_id", $this->post_id);
        $stmt->bindParam(":created_at", $this->created);
        $stmt->bindParam(":updated_at", $this->timestamp);
        

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
public function countAll(){
 
        $query = "SELECT comment_id FROM " . $this->table_name . " WHERE liveflag=1 AND post_id=? ";
     
        $stmtt = $this->conn->prepare( $query );
        $stmtt->bindParam(1,$this->post_id);
        $stmtt->execute();
     
        $num1 = $stmtt->rowCount();
     
        return $num1;
    }
    public function countCAll(){
 
        $query = "SELECT comment_id FROM " . $this->table_name . " ";
     
        $stmtt = $this->conn->prepare( $query );
      
        $stmtt->execute();
     
        $num1 = $stmtt->rowCount();
     
        return $num1;
    }
    function readOne(){
 
        $query = "SELECT
                    email,comment_id,comment_body,created_at
                FROM
                    " . $this->table_name . "  
                    WHERE liveflag=1 AND post_id=?               
                ORDER BY
                    email ASC
                " ;
     
        $stmtt = $this->conn->prepare( $query );
        $stmtt->bindParam(1,$this->post_id);
        $stmtt->execute();
         
      return $stmtt;
    }
    function readAllC(){
        $query = "SELECT
                   blogpost.title,comment_body,comment_id
                      FROM  " . $this->table_name . "  left join
                   blogpost
                    on comments.post_id=blogpost.post_id
                    
                " ;
        $stmttt = $this->conn->prepare( $query );
        $stmttt->execute();
         
      return $stmttt;
    }
    
    function update(){
    
        $query = "UPDATE " . $this->table_name . " set liveflag=1 WHERE comment_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->comment_id);
    
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    function delete(){
    
        $query = "DELETE FROM " . $this->table_name . "  WHERE comment_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->comment_id);
    
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    function readAll($from_record_num, $records_per_page){
 
        $query = "SELECT
                   comments.post_id,comments.comment_body,comments.comment_id,comments.email,blogpost.title,blogpost.titledes,comments.created_at
                FROM
                    " . $this->table_name . "
                left join blogpost
                ON comments.post_id=blogpost.post_id
                ORDER BY
                    email ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }
//     function update1(){
        
//         $query = "UPDATE FROM " . $this->table_name . " SET liveflag=1 WHERE comment_id = ?";
         
//         $stmt = $this->conn->prepare($query);
//         $stmt->bindParam(1, $this->comment_id);
     
//         if($result1 = $stmt->execute()){
//             return true;
//         }else{
//             return false;
//         }
        
         
//     }
//     // delete the product
//   function delete1(){
     
//         $query = "DELETE FROM " . $this->table_name . " WHERE comment_id = ?";
         
//         $stmt = $this->conn->prepare($query);
//         $stmt->bindParam(1, $this->comment_id);
     
//         if($result = $stmt->execute()){
//             return true;
//         }else{
//             return false;
//         }
public function countAllc(){
 
    $query = "SELECT comment_id FROM " . $this->table_name . " ";
 
    $stmtt = $this->conn->prepare( $query );
   
    $stmtt->execute();
 
    $num1 = $stmtt->rowCount();
 
    return $num1;
}
}

?>