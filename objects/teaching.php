<?php


class teaching
{
    private $conn;
    private $table_name = "fdp";
    public $id;
    public $title;
    public $organized_by;
    public $level;
    public $from_date;
    public $to_date;
    public $duration;
    public $certificate;
    public $schudule;
    public $photo1;
    public $photo2;
    public $modification_on;
  
    

  
    public function __construct($db){
        $this->conn = $db;
       // echo $this->conn;
    }



    // read downloads by search term
    public function search($search_term, $from_record_num, $records_per_page)
    {
        // select query
        $query = "SELECT   id, title, organized_by, level, from_date, to_date, duration, certificate, schudule, photo1,photo2,creation_on,modification_on,soft_delete
        FROM " . $this->table_name .  " where title LIKE ? OR organized_by LIKE ? LIMIT ?, ?";
                
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
                   id, title, organized_by, level, from_date, to_date, duration, certificate, schudule, photo1,photo2,creation_on,modification_on,soft_delete
                FROM
                    " . $this->table_name . " where soft_delete=0";
              
             
           //  echo $query;      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    } 
    
        
    function readOne(){
 
        $query = "SELECT   id, title, organized_by, level, from_date, to_date, duration, certificate,schudule,photo1,photo2,creation_on,modification_on,soft_delete
        FROM " . $this->table_name .  " where id = ?  LIMIT  0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->title = $row['title'];

        $this->organized_by = $row['organized_by'];
        $this->level = $row['level'];
        $this->from_date = $row['from_date'];
        $this->to_date = $row['to_date'];
        $this->duration = $row['duration'];
        $this->certificate = $row['certificate'];
        $this->	schudule = $row['schudule'];
        $this->photo1 = $row['photo1'];
        $this->photo2 = $row['photo2'];
        $this->creation_on = $row['creation_on'];
        $this->modification_on = $row['modification_on'];
        $this->soft_delete = $row['soft_delete'];
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

         $flagcertificate=0;
         $flagschudule=0;
         $flagphoto1=0;
         $flagphoto2=0;
         
        // posted values
    
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->organized_by=htmlspecialchars(strip_tags($this->organized_by));
        $this->level=htmlspecialchars(strip_tags($this->level));
        $this->from_date=htmlspecialchars(strip_tags($this->from_date));
        $this->to_date=htmlspecialchars(strip_tags($this->to_date));
        $this->duration=htmlspecialchars(strip_tags($this->duration));
        $this->certificate=htmlspecialchars(strip_tags($this->certificate));
        $this->schudule=htmlspecialchars(strip_tags($this->schudule));
        $this->photo1=htmlspecialchars(strip_tags($this->photo1));
        $this->photo2=htmlspecialchars(strip_tags($this->photo2));
        //$this->creation_on=htmlspecialchars(strip_tags($this->creation_on));
      //      $this->modification_on=htmlspecialchars(strip_tags($this->modification_on));
        // $this->soft_delete=htmlspecialchars(strip_tags($this->soft_delete));
           
        
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                   
                    title = :title,
                    organized_by = :organized_by,
                    level = :level,
                    from_date = :from_date,
                    to_date = :to_date,
                    duration = :duration";

        if( (isset($this->certificate) && (string) $this->certificate !== ''))           
             {
                     $query = $query . " certificate = :certificate,";
                     $flagcertificate=1;
             }

       if( (isset($this->schudule) && (string) $this->schudule !== ''))           
        {
           $query = $query . " schudule = :schudule,";
           $flagschudule=1;
        }
                    
        if( (isset($this->photo1) && (string) $this->photo1 !== ''))           
        {
            $query = $query . " photo1 = :photo1,";
            $flagphoto1=1;
        }
       
        if( (isset($this->photo2) && (string) $this->photo2 !== ''))           
        {
      
            $query = $query . " photo2  = :photo2,";
            $flagphoto2=1;
            
        }
        
        $query= $query . "
                WHERE
                    id = :id";       

        //echo "$query";

        
  
        $stmt = $this->conn->prepare($query);
    
        
         
         // bind values 
        //  $stmt->bindParam(":id", $this->id);
         $stmt->bindParam(":title", $this->title);
         $stmt->bindParam(":organized_by", $this->organized_by);
         $stmt->bindParam(":level", $this->level);
         $stmt->bindParam(":from_date", $this->from_date);
         $stmt->bindParam(":to_date", $this->to_date);
         $stmt->bindParam(":duration", $this->duration);
         if($flagcertificate ==1)
         {
            $stmt->bindParam(":certificate", $this->certificate);
         }
         if($flagschudule ==1)
         {
            $stmt->bindParam(":schudule", $this->schudule);
         }
         if($flagphoto1 ==1)
         {
            $stmt->bindParam(":photo1", $this->photo1);
         }
         if($flagphoto2 ==1)
         {
            $stmt->bindParam(":photo2", $this->photo2);
         }
        // $stmt->bindParam(":modification_on", $this->modification_on);
         $stmt->bindParam(":id", $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    function delete(){
    
        $query = "update " . $this->table_name . " set soft_delete='1' WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
    
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function create(){
 
        $query = "INSERT INTO
                        " . $this->table_name . "
                SET
                        title=:title, organized_by=:organized_by,  level=:level, from_date=:from_date, to_date=:to_date, duration=:duration, certificate=:certificate,  schudule=:schudule,  photo1=:photo1,  photo2=:photo2";
                    
        //echo $query;

        $stmt = $this->conn->prepare($query);
        // posted values
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->organized_by=htmlspecialchars(strip_tags($this->organized_by));
        $this->level= htmlspecialchars(strip_tags($this->level));
        $this->from_date=htmlspecialchars(strip_tags($this->from_date));
        $this->to_date=htmlspecialchars(strip_tags($this->to_date));
        $this->duration=htmlspecialchars(strip_tags($this->duration));
        $this->certificate=htmlspecialchars(strip_tags($this->certificate));
        $this->schudule=htmlspecialchars(strip_tags($this->schudule));
        $this->photo1=htmlspecialchars(strip_tags($this->photo1));
        $this->photo2=htmlspecialchars(strip_tags($this->photo2));
    
            // to get time-stamp for 'created' field
          //  $this->timestamp = date('Y-m-d H:i:s');
           
            // bind values 
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":organized_by", $this->organized_by);
            $stmt->bindParam(":level", $this->level);
            $stmt->bindParam(":from_date", $this->from_date);
            $stmt->bindParam(":to_date", $this->to_date);
            $stmt->bindParam(":duration", $this->duration);
            $stmt->bindParam(":certificate", $this->certificate);
            $stmt->bindParam(":schudule", $this->schudule);
            $stmt->bindParam(":photo1", $this->photo1);
            $stmt->bindParam(":photo2", $this->photo2);
           
            
    
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
 
    }



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


  
    // will upload image file to server
    // function uploadPhoto1(){
    
    //     $result_message="";
    
    //     // now, if image is not empty, try to upload the image
    //     if($this->certificate){
    
    //         // sha1_file() function is used to make a unique file name
    //         $target_directory = "img/";
    //         $target_file = $target_directory . $this->certificate;
    //         $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
    
    //         // error message is empty
    //         $file_upload_error_messages="";
    //         // make sure that file is a real image
    //         $check = getimagesize($_FILES["certificate"]["tmp_name"]);
    //         if($check!==false){
    //             // submitted file is an image
    //         }else{
    //             $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
    //         }
            
    //         // make sure certain file types are allowed
    //         $allowed_file_types=array("jpg", "jpeg", "png", "gif");
    //         if(!in_array($file_type, $allowed_file_types)){
    //             $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
    //         }
            
    //         // If file already exist, the add timestamp to it and then save
    //         if(file_exists($target_file)){
    //             $filename = $_FILES['certificate']['name'];
    //         $filename = $filename.time();
    //             //$file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
    //         }
            
    //         // make sure submitted file is not too large, can't be larger than 1 MB
    //         if($_FILES['certificate']['size'] > (1024000)){
    //             $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
    //         }
            
    //         // make sure the 'uploads' folder exists
    //         // if not, create it
    //         if(!is_dir($target_directory)){
    //             mkdir($target_directory, 0777, true);
    //         }

    //         // if $file_upload_error_messages is still empty
    //         if(empty($file_upload_error_messages)){
    //             // it means there are no errors, so try to upload the file
    //             if(move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)){
    //                 // it means photo was uploaded
    //             }else{
    //                 $result_message.="<div class='alert alert-danger'>";
    //                     $result_message.="<div>Unable to upload photo.</div>";
    //                     $result_message.="<div>Update the record to upload photo.</div>";
    //                 $result_message.="</div>";
    //             }
    //         }
            
    //         // if $file_upload_error_messages is NOT empty
    //         else{
    //             // it means there are some errors, so show them to user
    //             $result_message.="<div class='alert alert-danger'>";
    //                 $result_message.="{$file_upload_error_messages}";
    //                 $result_message.="<div>Update the record to upload photo.</div>";
    //             $result_message.="</div>";
    //         }
    
    //     }
    
    //     return $result_message;
    // }
             // will upload pdf file to server
function uploadPdf1(){
    $result_message="";
    $filename="";
    // now, if pdf is not empty, try to upload the pdf
    if($this->schudule){
  
        // sha1_file() function is used to make a unique file name
        $target_directory = "pdf/";
        $target_file = $target_directory . $this->schudule;
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
            $filename = $_FILES['schudule']['name'];
            $filename = $filename.time();
           
            //$file_upload_error_messages.="<div>pdf already exists. Try to change file name.</div>";
        }
        
        // make sure submitted file is not too large, can't be larger than 1 MB
        if($_FILES['schudule']['size'] > (1024000)){
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
            if(move_uploaded_file($_FILES["schudule"]["tmp_name"], $target_file)){
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

  
//     $result_message="";
//     $filename="";
//     // now, if pdf is not empty, try to upload the pdf
//     if($this->schudule){
  
//         // sha1_file() function is used to make a unique file name
//         $target_directory = "pdf/";
//         $target_file = $target_directory . $this->schudule;
//         $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
  
//         // error message is empty
//         $file_upload_error_messages="";
       
        
//         // make sure certain file types are allowed
//         $allowed_file_types=array("pdf");
//         if(!in_array($file_type, $allowed_file_types)){
//             $file_upload_error_messages.="<div>Only pdf files are allowed.</div>";
//         }
        
//         // If file already exist, the add timestamp to it and then save
//         if(file_exists($target_file)){
//             $filename = $_FILES['schudule']['name'];
//             $filename = $filename.time();
           
//             //$file_upload_error_messages.="<div>pdf already exists. Try to change file name.</div>";
//         }
        
//         // make sure submitted file is not too large, can't be larger than 1 MB
//         if($_FILES['schudule']['size'] > (1024000)){
//             $file_upload_error_messages.="<div>Pdf must be less than 1 MB in size.</div>";
//         }
        
//         // make sure the 'uploads' folder exists
//         // if not, create it
//         if(!is_dir($target_directory)){
//             mkdir($target_directory, 0777, true);
//         }

//         // if $file_upload_error_messages is still empty
//         if(empty($file_upload_error_messages)){
//             // it means there are no errors, so try to upload the file
//             if(move_uploaded_file($_FILES["schudule"]["tmp_name"], $target_file)){
//                 // it means photo was uploaded
//             }else{
//                 $result_message.="<div class='alert alert-danger'>";
//                     $result_message.="<div>Unable to upload pdf.</div>";
//                     $result_message.="<div>Update the record to upload pdf.</div>";
//                 $result_message.="</div>";
//             }
//         }
        
//         // if $file_upload_error_messages is NOT empty
//         else{
//             // it means there are some errors, so show them to user
//             $result_message.="<div class='alert alert-danger'>";
//                 $result_message.="{$file_upload_error_messages}";
//                 $result_message.="<div>Update the record to upload pdf.</div>";
//             $result_message.="</div>";
//         }
  
//     }
  
//     return $result_message;
// }

   
    function uploadPhoto3(){
    
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


    function uploadPhoto4(){
    
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





        // will upload pdf file to server

}

//$foo = new Foo($db);
//$funcname = "Variable";
//$foo->create(); // This calls $foo->Variable()

?>