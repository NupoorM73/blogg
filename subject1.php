<?php


class subject
{
    private $conn;
    private $table_name = "sub";
    public $id;
    public $subjectname;
    public $level;
    public $softdelete;

    public $active;
    public function __construct($db){
        $this->conn = $db;
       // echo $this->conn;
    }



    // read downloads by search term
    public function search($search_term, $from_record_num, $records_per_page)
    {
        // select query
        $query = "SELECT   id, subjectname, level, softdelete
        FROM " . $this->table_name .  " where subjectname LIKE ? OR course LIKE ? LIMIT ?, ?";
                
        //echo "<br>" .$query;
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        
        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
        
        // execute query
        $stmt->execute();
        // echo "<br>" .$stmt->rowCount();
        
        // return values from database
        return $stmt;
    }
   
   public function countAll_BySearch($search_term){
        // select query
       $query = "SELECT
                   COUNT(*) as total_rows
               FROM
                       " . $this->table_name . " p 
               WHERE
                   p.name LIKE ? OR p.mobile LIKE ?";
    
        //echo "<br>" .$query;
       // prepare query statement
       $stmt = $this->conn->prepare( $query );
    
       // bind variable values
       $search_term = "%{$search_term}%";
       $stmt->bindParam(1, $search_term);
    
       $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
       return $row['total_rows'];
   }
   
    function readAll($from_record_num, $records_per_page){
 
        $query = "SELECT
                    subjectname, softdelete
                FROM
                    " . $this->table_name . "
                where level='UG' and softdelete=1
                ORDER BY createdon desc
                LIMIT
                    {$from_record_num}, {$records_per_page}";
                  
             
             //echo $query;      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    } 
    function readAll1($from_record_num, $records_per_page){
 
        $query = "SELECT
                    subjectname, softdelete
                FROM
                    " . $this->table_name . "
                where level='PG' and softdelete=1
                ORDER BY createdon desc
                LIMIT
                    {$from_record_num}, {$records_per_page}";
                  
             
             //echo $query;      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    } 
        
    function readOne(){
 
        $query = "SELECT   id, subjectname, level, softdelete
        FROM " . $this->table_name .  " where id = ?  LIMIT  0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->subjectname = $row['subjectname'];

        $this->level = $row['level'];
    
    }
    
    // used for paging products
    public function countAll(){
 
        $query = "SELECT id FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }
        
              
        
    function update(){

        
        // posted values
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->subjectname=htmlspecialchars(strip_tags($this->subjectname));
        $this->level=htmlspecialchars(strip_tags($this->level));
           
        
        $query = "UPDATE " . $this->table_name . "
                SET
                subjectname = :subjectname,
                level = :level,
                modifiedon = :modifiedon
                WHERE  id = :id";
                    

        
        //echo $query;
        $stmt = $this->conn->prepare($query);
    
        
         
         // bind values 
         $stmt->bindParam(":modifiedon", $this->modifiedon);
         $stmt->bindParam(":subjectname", $this->subjectname);
         $stmt->bindParam(":level", $this->level);
         $stmt->bindParam(":id", $this->id);
         
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    function delete(){
    
        $query = "update " . $this->table_name . " set softdelete=0 WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
    
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function create(){
 
        //write query
       
       
        $query = "INSERT INTO
                        " . $this->table_name . "
                SET
                subjectname=:subjectname, level=:level, softdelete=:softdelete";
                    
        //echo $query;


        $stmt = $this->conn->prepare($query);
        // posted values
        $this->subjectname=htmlspecialchars(strip_tags($this->subjectname));
        $this->level=htmlspecialchars(strip_tags($this->level));
        
       /* echo $this->subjectname;
        echo $this->level;*/

            $this->softdelete=1;
            // bind values 
            $stmt->bindParam(":subjectname", $this->subjectname);
            $stmt->bindParam(":level", $this->level);
            $stmt->bindParam(":softdelete", $this->softdelete);
    
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
 
    }
  
    // will upload image file to server




        // will upload pdf file to server

}

//$foo = new Foo($db);
//$funcname = "Variable";
//$foo->create(); // This calls $foo->Variable()

?>