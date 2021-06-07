<?php


class invtalks
{
    private $conn;
    private $table_name = "inv_talks";
    public $talk_id;
    public $title;
    public $organizedby;
    public $level;
    public $type;
    public $fromdate;
    public $todate;
    public $Duration;
    public $unit;
    public $certificate;
    public $schedule;
    public $photo1;
    public $photo2;
    public $softdelete;
   

    public function __construct($db){
        $this->conn = $db;
       // echo $this->conn;
    }



    // read invtalks by search term
    public function search($search_term, $from_record_num, $records_per_page)
    {
        // select query
        $query = "SELECT   talk_id, title, organizedby, level, type, fromdate, todate, Duration, unit, 
        certificate, schedule, photo1, photo2,softdelete
        FROM " . $this->table_name .  " where title LIKE ? OR organizedby LIKE ? LIMIT ?, ?";
                
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
       $query = "SELECT  talk_id
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
                    talk_id, title, organizedby, level, type, fromdate, todate, Duration, unit, certificate, schedule, photo1, photo2
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
 
        $query = "SELECT   talk_id, title, organizedby, level, type, fromdate, todate, Duration, unit, certificate, schedule, photo1, photo2
        FROM " . $this->table_name .  " where talk_id  = ?  LIMIT  0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->talk_id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->talk_id = $row['talk_id'];
        $this->title = $row['title'];

        $this->organizedby = $row['organizedby'];
        $this->level = $row['level'];
        $this->type = $row['type'];
        $this->fromdate = $row['fromdate'];
        $this->todate = $row['todate'];
        $this->Duration = $row['Duration'];
        $this->unit = $row['unit'];
        $this->certificate = $row['certificate'];
        $this->schedule = $row['schedule'];
        $this->photo1 = $row['photo1'];
        $this->photo2 = $row['photo2'];

    }
    
    // used for paging products
    public function countAll(){
 
        $query = "SELECT talk_id  FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }
        
              
        
    function update(){

        $flagPDF=0;
        $flagPDF1=0;
        $flagImg=0;
        $flagImg1=0;
       // posted values
       $this->talk_id=htmlspecialchars(strip_tags($this->talk_id));
       $this->title=htmlspecialchars(strip_tags($this->title));
       $this->organizedby=htmlspecialchars(strip_tags($this->organizedby));
       $this->level=htmlspecialchars(strip_tags($this->level));
       $this->type=htmlspecialchars(strip_tags($this->type));
       $this->fromdate=htmlspecialchars(strip_tags($this->fromdate));
       $this->todate=htmlspecialchars(strip_tags($this->todate));

       $this->Duration=htmlspecialchars(strip_tags($this->Duration));
       $this->unit=htmlspecialchars(strip_tags($this->unit));
       $this->certificate=htmlspecialchars(strip_tags($this->certificate));
       $this->schedule=htmlspecialchars(strip_tags($this->schedule));
       $this->photo1=htmlspecialchars(strip_tags($this->photo1));
       $this->photo2=htmlspecialchars(strip_tags($this->photo2));

          
       
       $query = "UPDATE
                   " . $this->table_name . "
               SET
                   title = :title,
                   organizedby = :organizedby,
                   level = :level,
                   type = :type,
                   fromdate = :fromdate,
                   todate = :todate,
                   Duration = :Duration,
                   unit = :unit,";
                   
       if( (isset($this->certificate) && (string) $this->certificate !== ''))           
       {
           $query = $query . " certificate = :certificate,";
           $flagPDF=1;
       }
       

       if( (isset($this->schedule) && (string) $this->schedule !== ''))           
       {
           $query = $query . " schedule = :schedule,";
           $flagPDF1=1;
       }
      
       if( (isset($this->photo1) && (string) $this->photo1 !== ''))           
       {
     
           $query = $query . " photo1  = :photo1,";
           $flagImg=1;
       }

       if( (isset($this->photo2) && (string) $this->photo2 !== ''))           
       {
     
           $query = $query . " photo2  = :photo2,";
           $flagImg1=1;
       }
       $query= $query ."modifiedon = :modifiedon
               WHERE
               talk_id  = :talk_id ";
       
 // echo $query;
       $stmt = $this->conn->prepare($query);
   
       
        
        // bind values 
        
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":organizedby", $this->organizedby);
        $stmt->bindParam(":level", $this->level);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":fromdate", $this->fromdate);
        $stmt->bindParam(":todate", $this->todate);
        $stmt->bindParam(":Duration", $this->Duration);
        $stmt->bindParam(":unit", $this->unit);


        if($flagPDF ==1)
        {
           $stmt->bindParam(":certificate", $this->certificate );
        }

        if($flagPDF1 ==1)
        {
           $stmt->bindParam(":schedule", $this->schedule );
        }

        if($flagImg ==1)
        {
           $stmt->bindParam(":photo1", $this->photo1);
        }

        if($flagImg1 ==1)
        {
           $stmt->bindParam(":photo2", $this->photo2);
        }

        $stmt->bindParam(":modifiedon", $this->modifiedon);

        $stmt->bindParam(":talk_id", $this->talk_id);
   
       // execute the query
       if($stmt->execute()){
           return true;
       }
   
       return false;
       
   }
    function delete(){
    
        $query = "update " . $this->table_name . " set softdelete=0 WHERE talk_id = ?";
        
        //echo "$query";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->talk_id);
    
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
                title=:title, organizedby=:organizedby, level=:level, type=:type, 
                fromdate=:fromdate, todate=:todate, Duration=:Duration, unit=:unit, 
                certificate=:certificate, schedule=:schedule, photo1=:photo1, photo2=:photo2, 
                createdon=:createdon, modifiedon=:modifiedon, softdelete=:softdelete";
                    
        // echo $query;

        $stmt = $this->conn->prepare($query);
        // posted values
        $this->title=htmlspecialchars(strip_tags($this->title));
        // echo "<br>$this->title";

        $this->organizedby=htmlspecialchars(strip_tags($this->organizedby));
        // echo "<br>$this->organizedby";

        $this->level=htmlspecialchars(strip_tags($this->level));
        // echo "<br>$this->level";

        $this->type=htmlspecialchars(strip_tags($this->type));
        // echo "<br>$this->type";

        $this->fromdate=htmlspecialchars(strip_tags($this->fromdate));
        // echo "<br>$this->fromdate";

        $this->todate=htmlspecialchars(strip_tags($this->todate));
        // echo "<br>$this->todate";

        $this->Duration=htmlspecialchars(strip_tags($this->Duration));
        // echo "<br>$this->Duration";

        $this->unit=htmlspecialchars(strip_tags($this->unit));
        // echo "<br>$this->unit";

         $this->certificate=htmlspecialchars(strip_tags($this->certificate));
        //  echo "<br>$this->certificate";

        $this->schedule=htmlspecialchars(strip_tags($this->schedule));
        // echo "<br>$this->schedule";

        $this->photo1=htmlspecialchars(strip_tags($this->photo1));
        // echo "<br>$this->photo1";

        $this->photo2=htmlspecialchars(strip_tags($this->photo2));
        // echo "<br>$this->photo2<br>";

        $this->softdelete=htmlspecialchars(strip_tags($this->softdelete));
        //echo "<br>$this->softdelete";
    
        // to get time-stamp for 'created' field
           // $this->timestamp = date('Y-m-d H:i:s');
            $this->softdelete=1;
            // bind values 
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':organizedby', $this->organizedby);
            $stmt->bindParam(':level', $this->level);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':fromdate', $this->fromdate);
            $stmt->bindParam(':todate', $this->todate);
            $stmt->bindParam(':Duration', $this->Duration);
            $stmt->bindParam(':unit', $this->unit);
            $stmt->bindParam(':certificate', $this->certificate);
            $stmt->bindParam(':schedule', $this->schedule);
            $stmt->bindParam(':photo1', $this->photo1);
            $stmt->bindParam(':photo2', $this->photo2);
            $stmt->bindParam(":createdon", $this->timestamp);
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
        if($this->certificate){
      
            // sha1_file() function is used to make a unique file name
            $target_directory = "pdf/";
            $target_file = $target_directory . $this->certificate;
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
                $filename = $_FILES['certificate']['name'];
                $filename = $filename.time();
               
                //$file_upload_error_messages.="<div>pdf already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['certificate']['size'] > (1024000)){
                $file_upload_error_messages.="<div>certificate must be less than 1 MB in size.</div>";
            }
            
            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
    
            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload certificate.</div>";
                        $result_message.="<div>Update the record to upload certificate.</div>";
                    $result_message.="</div>";
                }
            }
            
            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload certificate.</div>";
                $result_message.="</div>";
            }
      
        }
      
        return $result_message;
    }


    function uploadPdf1(){
  
        $result_message="";
        $filename="";
        // now, if pdf is not empty, try to upload the pdf
        if($this->schedule){
      
            // sha1_file() function is used to make a unique file name
            $target_directory = "pdf/";
            $target_file = $target_directory . $this->schedule;
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
                $filename = $_FILES['schedule']['name'];
                $filename = $filename.time();
               
                //$file_upload_error_messages.="<div>pdf already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['schedule']['size'] > (1024000)){
                $file_upload_error_messages.="<div>schedule must be less than 1 MB in size.</div>";
            }
            
            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
    
            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["schedule"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload schedule.</div>";
                        $result_message.="<div>Update the record to upload schedule.</div>";
                    $result_message.="</div>";
                }
            }
            
            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload schedule.</div>";
                $result_message.="</div>";
            }
      
        }
      
        return $result_message;
    }
  
    // will upload image file to server
    function uploadPhoto(){
    
        $result_message="";
    
        // now, if image is not empty, try to upload the image
        if($this->photo1){
    
            // sha1_file() function is used to make a unique file name
            $target_directory = "img/";
            $target_file = $target_directory . $this->photo1;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
    
            // error message is empty
            $file_upload_error_messages="";
            // make sure that file is a real image
            $check = getimagesize($_FILES["photo1"]["tmp_name"]);
            if($check!==false){
                // submitted file is an image
            }else{
                $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
            }
            
            // make sure certain file types are allowed
            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }
            
            // If file already exist, the add timestamp to it and then save
            if(file_exists($target_file)){
                $filename = $_FILES['photo1']['name'];
            $filename = $filename.time();
                //$file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['photo1']['size'] > (1024000)){
                $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
            }
            
            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }

            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["photo1"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload photo.</div>";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
            }
            
            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload photo.</div>";
                $result_message.="</div>";
            }
    
        }
    
        return $result_message;
    }

// will upload image file to server
function uploadPhoto1(){
    
    $result_message="";

    // now, if image is not empty, try to upload the image
    if($this->photo2){

        // sha1_file() function is used to make a unique file name
        $target_directory = "img/";
        $target_file = $target_directory . $this->photo2;
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

        // error message is empty
        $file_upload_error_messages="";
        // make sure that file is a real image
        $check = getimagesize($_FILES["photo2"]["tmp_name"]);
        if($check!==false){
            // submitted file is an image
        }else{
            $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
        }
        
        // make sure certain file types are allowed
        $allowed_file_types=array("jpg", "jpeg", "png", "gif");
        if(!in_array($file_type, $allowed_file_types)){
            $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
        }
        
        // If file already exist, the add timestamp to it and then save
        if(file_exists($target_file)){
            $filename = $_FILES['photo2']['name'];
        $filename = $filename.time();
            //$file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
        }
        
        // make sure submitted file is not too large, can't be larger than 1 MB
        if($_FILES['photo2']['size'] > (1024000)){
            $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
        }
        
        // make sure the 'uploads' folder exists
        // if not, create it
        if(!is_dir($target_directory)){
            mkdir($target_directory, 0777, true);
        }

        // if $file_upload_error_messages is still empty
        if(empty($file_upload_error_messages)){
            // it means there are no errors, so try to upload the file
            if(move_uploaded_file($_FILES["photo2"]["tmp_name"], $target_file)){
                // it means photo was uploaded
            }else{
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="<div>Unable to upload photo.</div>";
                    $result_message.="<div>Update the record to upload photo.</div>";
                $result_message.="</div>";
            }
        }
        
        // if $file_upload_error_messages is NOT empty
        else{
            // it means there are some errors, so show them to user
            $result_message.="<div class='alert alert-danger'>";
                $result_message.="{$file_upload_error_messages}";
                $result_message.="<div>Update the record to upload photo.</div>";
            $result_message.="</div>";
        }

    }

    return $result_message;
}



        

}



?>