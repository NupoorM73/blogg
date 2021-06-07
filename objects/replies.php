<?php
Class Replies {
 private $conn;
 private $table_name ="replies";
 
 //object properties
 public $email;
 public $body;
 public $comment_id;
 public $reply_id;
 public $post_id;
 public $created_at;
 public $updated_at;
 public $approval;


public function __construct($db){
        $this->conn = $db;
}
function createR(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    email=:email,body=:body,comment_id=:comment_id,reply_id=:reply_id,post_id=:post_id,created_at=:created_at,updated_at=:updated_at, approval = 0";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->comment_id=htmlspecialchars(strip_tags($this->comment_id));
        $this->reply_id=htmlspecialchars(strip_tags($this->reply_id));
        $this->post_id=htmlspecialchars(strip_tags($this->post_id));
        $this->created_at=htmlspecialchars(strip_tags($this->created_at));
        $this->updated_at=htmlspecialchars(strip_tags($this->updated_at));

        $this->created=date('Y-m-d');

        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d');
 
        // bind values 
        $stmt->bindParam("email",$this->email );
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":comment_id", $this->comment_id);
        $stmt->bindParam(":reply_id", $this->reply_id);
        $stmt->bindParam(":post_id", $this->post_id);
        $stmt->bindParam(":created_at", $this->created);
        $stmt->bindParam(":updated_at", $this->timestamp);
        

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function readRAll(){
 
        $query = "SELECT
                    email,body,comment_id
                FROM
                    " . $this->table_name . "
                WHERE approval=1 & post_id=?

                ORDER BY
                    email ASC
                " 
               ;
     
        $stmttr = $this->conn->prepare( $query );
        $stmttr->bindParam(1, $this->post_id);
        $stmttr->execute();
        
     
        return $stmttr;
    }
    function readAllR(){
 
        $query = "SELECT
                    blogpost.email,blogpost.title,body,replies.reply_id
                FROM  " . $this->table_name . " ,blogpost
               WHERE  replies.post_id=blogpost.post_id AND comment_id in (SELECT comment_id from blogpost,comments WHERE blogpost.post_id=comments.post_id AND blogpost.email='".$_SESSION['email']."')
                 " ;
        
        $stmttr = $this->conn->prepare( $query );
        //$stmttr->bindParam(1, $this->post_id);
        $stmttr->execute();
        
     
        return $stmttr;
    }
    function readOne(){
 
        $query = "SELECT
                    email, body,comment_id
                FROM
                    " . $this->table_name . "
                WHERE
                    comment_id = ?
                LIMIT
                    0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->comment_id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->email = $row['email'];
        $this->body = $row['body'];
        
    }
    public function countAll(){
 
        $query = "SELECT reply_id FROM " . $this->table_name . " WHERE approval=1 AND post_id=? ";
     
        $stmtt = $this->conn->prepare( $query );
        $stmtt->bindParam(1,$this->post_id);
        $stmtt->execute();
     
        $num1 = $stmtt->rowCount();
     
        return $num1;
    }
    public function countRAll(){
 
        $query = "SELECT reply_id FROM " . $this->table_name . " ";
     
        $stmtt = $this->conn->prepare( $query );
        
        $stmtt->execute();
     
        $num1 = $stmtt->rowCount();
     
        return $num1;
    }
    function update(){
    
        $query = "UPDATE " . $this->table_name . " set approval=1 WHERE reply_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->reply_id);
    
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    function delete(){
    
        $query = "DELETE  FROM " . $this->table_name . "  WHERE reply_id = ? ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->reply_id);
    
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    function readAll($from_record_num, $records_per_page){
 
        $query = "SELECT
                  replies.post_id,replies.body,replies.reply_id,replies.comment_id,replies.email,blogpost.title,blogpost.titledes,replies.created_at
                FROM
                    " . $this->table_name . "
                left join blogpost
                ON replies.post_id=blogpost.post_id 
                ORDER BY
                    email ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }
    public function countAllc(){
 
        $query = "SELECT reply_id FROM " . $this->table_name . " ";
     
        $stmtt = $this->conn->prepare( $query );
       
        $stmtt->execute();
     
        $num1 = $stmtt->rowCount();
     
        return $num1;
    }
    function delete1(){
    
        $query = "DELETE  FROM " . $this->table_name . "  WHERE comment_id = ? ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->comment_id);
    
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}










?>