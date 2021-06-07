<?php


class rolres
{
    private $conn;
    private $table_name = "roles_and_responsibility";
    public $role_id;
    public $name_commitee;
    public $role;
    public $level;
    public $academic_year;
    public $name_event;
    public $letter_appointment;
    public $date_appointment;
    public $desc_role;
    public $report_task;
    public $createdby;
   // public $createdon;
    public $modifiedby;
   // public $modifiedon;

    public $softdelete;
   

    public function __construct($db){
        $this->conn = $db;
       // echo $this->conn;
    }



    // read invtalks by search term
    public function search($search_term, $from_record_num, $records_per_page)
    {
        // select query
        $query = "SELECT   role_id , name_commitee, role, level, academic_year, name_event, letter_appointment, date_appointment, desc_role, 
        report_task, createdby, modifiedby,softdelete
        FROM " . $this->table_name .  " where name_commitee LIKE ? OR role LIKE ? LIMIT ?, ?";
                
        //echo "$query";
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
       $query = "SELECT  role_id 
                   COUNT(*) as total_rows
               FROM
                       " . $this->table_name . " p 
               WHERE
                   p.name LIKE ? OR p.mobile LIKE ?";
    
        //echo "$query";
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
                    role_id , name_commitee, role, level, academic_year, name_event, letter_appointment, date_appointment, desc_role, 
        report_task, createdby, modifiedby
                FROM
                    " . $this->table_name . "
                where softdelete=1
                ORDER BY createdon desc
                LIMIT
                    {$from_record_num}, {$records_per_page}";
                  //  echo "$query";
                  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    } 
    
        
    function readOne(){
 
        $query = "SELECT   role_id , name_commitee, role, level, academic_year, name_event, letter_appointment, date_appointment, desc_role, 
        report_task, createdby, modifiedby
        FROM " . $this->table_name .  " where role_id  = ?  LIMIT  0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->role_id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->role_id = $row['role_id'];
        $this->name_commitee = $row['name_commitee'];

        $this->role = $row['role'];
        $this->level = $row['level'];
        $this->academic_year = $row['academic_year'];
        $this->name_event = $row['name_event'];
        $this->letter_appointment = $row['letter_appointment'];
        $this->date_appointment = $row['date_appointment'];
        $this->desc_role = $row['desc_role'];
        $this->report_task = $row['report_task'];
        $this->createdby = $row['createdby'];
        $this->modifiedby = $row['modifiedby'];
    }
    
    // used for paging products
    public function countAll(){
 
        $query = "SELECT role_id  FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }
        

        
    function update(){

        $flagPDF=0;
        $flagPDF1=0;
       // posted values
       $this->role_id=htmlspecialchars(strip_tags($this->role_id));
       $this->name_commitee=htmlspecialchars(strip_tags($this->name_commitee));
       $this->role=htmlspecialchars(strip_tags($this->role));
       $this->level=htmlspecialchars(strip_tags($this->level));
       $this->academic_year=htmlspecialchars(strip_tags($this->academic_year));
       $this->name_event=htmlspecialchars(strip_tags($this->name_event));
       $this->letter_appointment=htmlspecialchars(strip_tags($this->letter_appointment));

       $this->date_appointment=htmlspecialchars(strip_tags($this->date_appointment));
       $this->desc_role=htmlspecialchars(strip_tags($this->desc_role));
       $this->report_task=htmlspecialchars(strip_tags($this->report_task));
       $this->createdby=htmlspecialchars(strip_tags($this->createdby));
       $this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));


          
       
       $query = "UPDATE
                   " . $this->table_name . "
               SET
                   name_commitee = :name_commitee,
                   role = :role,
                   level = :level,
                   academic_year = :academic_year,
                   name_event = :name_event,";

        if( (isset($this->letter_appointment) && (string) $this->letter_appointment !== ''))           
        {
            $query = $query . " letter_appointment = :letter_appointment,";
            $flagPDF=1;
        }


                $query= $query ." date_appointment = :date_appointment,
                                  desc_role = :desc_role,";

                                  
       if( (isset($this->report_task) && (string) $this->report_task !== ''))           
       {
           $query = $query . " report_task = :report_task,";
           $flagPDF1=1;
       }
      

       $query= $query ."createdby = :createdby,
                        modifiedby = :modifiedby,
                        modifiedon = :modifiedon
               WHERE
               role_id  = :role_id ";
       
 // echo $query;
       $stmt = $this->conn->prepare($query);
   

        
        // bind values 
        
        $stmt->bindParam(":name_commitee", $this->name_commitee);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":level", $this->level);
        $stmt->bindParam(":academic_year", $this->academic_year);
        $stmt->bindParam(":name_event", $this->name_event);

        if($flagPDF ==1)
        {
           $stmt->bindParam(":letter_appointment", $this->letter_appointment );
        }

        $stmt->bindParam(":date_appointment", $this->date_appointment);

        $stmt->bindParam(":desc_role", $this->desc_role);

        if($flagPDF1 ==1)
        {
           $stmt->bindParam(":report_task", $this->report_task );
        }


        $stmt->bindParam(":createdby", $this->createdby);

        $stmt->bindParam(":modifiedby", $this->modifiedby);

        $stmt->bindParam(":modifiedon", $this->modifiedon);

        $stmt->bindParam(":role_id", $this->role_id);
   
       // execute the query
       if($stmt->execute()){
           return true;
       }
   
       return false;
       


   }
    function delete(){
    
        $query = "update " . $this->table_name . " set softdelete=0 WHERE role_id = ?";
        
        //echo "$query";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->role_id);
    
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
                name_commitee=:name_commitee, role=:role, level=:level, academic_year=:academic_year, 
                name_event=:name_event, letter_appointment=:letter_appointment, date_appointment=:date_appointment,
                desc_role=:desc_role, report_task=:report_task, createdby=:createdby, createdon=:createdon, modifiedby=:modifiedby, 
                 modifiedon=:modifiedon, softdelete=:softdelete";
                    
         //echo $query;


        $stmt = $this->conn->prepare($query);
        // posted values
        $this->name_commitee=htmlspecialchars(strip_tags($this->name_commitee));
       // echo "<br>$this->name_commitee";

        $this->role=htmlspecialchars(strip_tags($this->role));
         //echo "<br>$this->role";

        $this->level=htmlspecialchars(strip_tags($this->level));
        // echo "<br>$this->level";

        $this->academic_year=htmlspecialchars(strip_tags($this->academic_year));
         //echo "<br>$this->academic_year";

        $this->name_event=htmlspecialchars(strip_tags($this->name_event));
        // echo "<br>$this->name_event";

        $this->letter_appointment=htmlspecialchars(strip_tags($this->letter_appointment));
        // echo "<br>$this->letter_appointment";

        $this->date_appointment=htmlspecialchars(strip_tags($this->date_appointment));
         //echo "<br>$this->date_appointment";

        $this->desc_role=htmlspecialchars(strip_tags($this->desc_role));
         //echo "<br>$this->desc_role";

         $this->report_task=htmlspecialchars(strip_tags($this->report_task));
          //echo "<br>$this->report_task";

        $this->createdby=htmlspecialchars(strip_tags($this->createdby));
        // echo "<br>$this->createdby";


        $this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));
         //echo "<br>$this->modifiedby";


        $this->softdelete=htmlspecialchars(strip_tags($this->softdelete));
        echo "<br>$this->softdelete";

        // to get time-stamp for 'created' field
           $this->timestamp = date('Y-m-d H:i:s');
            $this->softdelete=1;
            // bind values 
            $stmt->bindParam(':name_commitee', $this->name_commitee);
            $stmt->bindParam(':role', $this->role);
            $stmt->bindParam(':level', $this->level);
            $stmt->bindParam(':academic_year', $this->academic_year);
            $stmt->bindParam(':name_event', $this->name_event);
            $stmt->bindParam(':letter_appointment', $this->letter_appointment);
            $stmt->bindParam(':date_appointment', $this->date_appointment);
            $stmt->bindParam(':desc_role', $this->desc_role);
            $stmt->bindParam(':report_task', $this->report_task);
            $stmt->bindParam(':createdby', $this->createdby);
            $stmt->bindParam(":createdon", $this->timestamp);
            $stmt->bindParam(':modifiedby', $this->modifiedby);
            $stmt->bindParam(":modifiedon", $this->timestamp);
            $stmt->bindParam(':softdelete', $this->softdelete); 

    
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
            
    }

// will upload certificate file to server

    function uploadPdf(){
  
        $result_message="";
        $filename="";
        // now, if pdf is not empty, try to upload the pdf
        if($this->letter_appointment){
      
            // sha1_file() function is used to make a unique file name
            $target_directory = "pdf/";
            $target_file = $target_directory . $this->letter_appointment;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
      
            // error message is empty
            $file_upload_error_messages="";
           
            
            // make sure certain file types are allowed
            $allowed_file_types=array("pdf");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only pdf files are allowed.</div>";
            }
            
            // If file already exist, the add timestamp to it and then save
            if(file_exists($target_file)){
                $filename = $_FILES['letter_appointment']['name'];
                $filename = $filename.time();
               
                //$file_upload_error_messages.="<div>pdf already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['letter_appointment']['size'] > (1024000)){
                $file_upload_error_messages.="<div>letter_appointment must be less than 1 MB in size.</div>";
            }
            
            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
    
            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["letter_appointment"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload letter_appointment.</div>";
                        $result_message.="<div>Update the record to upload letter_appointment.</div>";
                    $result_message.="</div>";
                }
            }
            
            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload letter_appointment.</div>";
                $result_message.="</div>";
            }
      
        }
      
        return $result_message;
    }


    function uploadPdf1(){
  
        $result_message="";
        $filename="";
        // now, if pdf is not empty, try to upload the pdf
        if($this->report_task){
      
            // sha1_file() function is used to make a unique file name
            $target_directory = "pdf/";
            $target_file = $target_directory . $this->report_task;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
      
            // error message is empty
            $file_upload_error_messages="";
           
            
            // make sure certain file types are allowed
            $allowed_file_types=array("pdf");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only pdf files are allowed.</div>";
            }
            
            // If file already exist, the add timestamp to it and then save
            if(file_exists($target_file)){
                $filename = $_FILES['report_task']['name'];
                $filename = $filename.time();
               
                //$file_upload_error_messages.="<div>pdf already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['report_task']['size'] > (1024000)){
                $file_upload_error_messages.="<div>report_task must be less than 1 MB in size.</div>";
            }
            
            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
    
            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["report_task"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload report_task.</div>";
                        $result_message.="<div>Update the record to upload report_task.</div>";
                    $result_message.="</div>";
                }
            }
            
            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload report_task.</div>";
                $result_message.="</div>";
            }
      
        }
      
        return $result_message;
    }
  
  


        

}



?>