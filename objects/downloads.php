<?php


class Downloads
{
    private $conn;
    private $table_name = "tbl_download";
    public $downloads_id;
    public $title;
    public $course;
    public $pdf;
    public $img;
    public $ppt;
    public $video_link;
    public $uploadedOn;
    public $status;

    public $active;
    public function __construct($db){
        $this->conn = $db;
       // echo $this->conn;
    }



    // read downloads by search term
    public function search($search_term, $from_record_num, $records_per_page)
    {
        // select query
        $query = "SELECT   download_id, title, course, pdf, img, ppt, video_link, created, status
        FROM " . $this->table_name .  " where title LIKE ? OR course LIKE ? LIMIT ?, ?";
                
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
                    download_id, title, course, pdf, img, ppt, video_link, created, status
                FROM
                    " . $this->table_name . "
                where status=1
                ORDER BY created desc
                LIMIT
                    {$from_record_num}, {$records_per_page}";
             
             //echo $query;      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    } 
    
        
    function readOne(){
 
        $query = "SELECT   download_id, title, course, pdf, img, ppt, video_link, created, status
        FROM " . $this->table_name .  " where download_id = ?  LIMIT  0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->download_id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->download_id = $row['download_id'];
        $this->title = $row['title'];

        $this->course = $row['course'];
        $this->pdf = $row['pdf'];
        $this->img = $row['img'];
        $this->ppt = $row['ppt'];
        $this->video_link = $row['video_link'];
        $this->uploadedOn = $row['created'];
    }
    
    // used for paging products
    public function countAll(){
 
        $query = "SELECT download_id FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }
        
              
        
    function update(){

         $flagPDF=0;
         $flagImg=0;
         $flagPPT=0;
        // posted values
        $this->downloads_id=htmlspecialchars(strip_tags($this->downloads_id));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->course=htmlspecialchars(strip_tags($this->course));
        $this->pdf=htmlspecialchars(strip_tags($this->pdf));
       
        $this->img=htmlspecialchars(strip_tags($this->img));
        $this->ppt=htmlspecialchars(strip_tags($this->ppt));
        $this->video_link=htmlspecialchars(strip_tags($this->video_link));
           
        
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    title = :title,
                    course = :course,";
                    
        if( (isset($this->pdf) && (string) $this->pdf !== ''))           
        {
            $query = $query . " pdf = :pdf,";
            $flagPDF=1;
        }
       
        if( (isset($this->img) && (string) $this->img !== ''))           
        {
      
            $query = $query . " img  = :img,";
            $flagImg=1;
        }
        if( (isset($this->ppt) && (string) $this->ppt !== ''))           
        {
            $query = $query . " ppt  = :ppt,";
            $flagPPT=1;
        }

        $query= $query . "video_link  = :video_link
                WHERE
                    download_id = :download_id";
        
  // echo $query;
        $stmt = $this->conn->prepare($query);
    
        
         
         // bind values 
         
         $stmt->bindParam(":title", $this->title);
         $stmt->bindParam(":course", $this->course);
         if($flagPDF ==1)
         {
            $stmt->bindParam(":pdf", $this->pdf );
         }
         if($flagImg ==1)
         {
            $stmt->bindParam(":img", $this->img);
         }
         if($flagPPT ==1)
         {
            $stmt->bindParam(":ppt", $this->ppt);
         }
         $stmt->bindParam(":video_link", $this->video_link);
         $stmt->bindParam(":download_id", $this->downloads_id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    function delete(){
    
        $query = "update " . $this->table_name . " set status=0 WHERE download_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->download_id);
    
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
                        title=:title, course=:course, pdf=:pdf,  img=:img, ppt=:ppt, video_link=:video_link, created=:created,  status=:status";
                    
        //echo $query;

        $stmt = $this->conn->prepare($query);
        // posted values
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->course=htmlspecialchars(strip_tags($this->course));
        $this->pdf=htmlspecialchars(strip_tags($this->pdf));
        $this->img=htmlspecialchars(strip_tags($this->img));
        $this->ppt=htmlspecialchars(strip_tags($this->ppt));
        $this->video_link=htmlspecialchars(strip_tags($this->video_link));
    
            // to get time-stamp for 'created' field
            $this->timestamp = date('Y-m-d H:i:s');
            $this->status=1;
            // bind values 
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":course", $this->course);
            $stmt->bindParam(":pdf", $this->pdf);
            $stmt->bindParam(":img", $this->img);
            $stmt->bindParam(":ppt", $this->ppt);
            $stmt->bindParam(":video_link", $this->video_link);
            $stmt->bindParam(":created", $this->timestamp);
            $stmt->bindParam(":status", $this->status);
    
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
 
    }
  
    // will upload image file to server
    function uploadPhoto(){
    
        $result_message="";
    
        // now, if image is not empty, try to upload the image
        if($this->img){
    
            // sha1_file() function is used to make a unique file name
            $target_directory = "img/";
            $target_file = $target_directory . $this->img;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
    
            // error message is empty
            $file_upload_error_messages="";
            // make sure that file is a real image
            $check = getimagesize($_FILES["img"]["tmp_name"]);
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
                $filename = $_FILES['pdf']['name'];
            $filename = $filename.time();
                //$file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['img']['size'] > (1024000)){
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
                if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
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
function uploadPdf(){
  
    $result_message="";
    $filename="";
    // now, if pdf is not empty, try to upload the pdf
    if($this->pdf){
  
        // sha1_file() function is used to make a unique file name
        $target_directory = "pdf/";
        $target_file = $target_directory . $this->pdf;
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
            $filename = $_FILES['pdf']['name'];
            $filename = $filename.time();
           
            //$file_upload_error_messages.="<div>pdf already exists. Try to change file name.</div>";
        }
        
        // make sure submitted file is not too large, can't be larger than 1 MB
        if($_FILES['pdf']['size'] > (1024000)){
            $file_upload_error_messages.="<div>Pdf must be less than 1 MB in size.</div>";
        }
        
        // make sure the 'uploads' folder exists
        // if not, create it
        if(!is_dir($target_directory)){
            mkdir($target_directory, 0777, true);
        }

        // if $file_upload_error_messages is still empty
        if(empty($file_upload_error_messages)){
            // it means there are no errors, so try to upload the file
            if(move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file)){
                // it means photo was uploaded
            }else{
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="<div>Unable to upload pdf.</div>";
                    $result_message.="<div>Update the record to upload pdf.</div>";
                $result_message.="</div>";
            }
        }
        
        // if $file_upload_error_messages is NOT empty
        else{
            // it means there are some errors, so show them to user
            $result_message.="<div class='alert alert-danger'>";
                $result_message.="{$file_upload_error_messages}";
                $result_message.="<div>Update the record to upload pdf.</div>";
            $result_message.="</div>";
        }
  
    }
  
    return $result_message;
}

        // will upload ppt file to server
        function uploadPpt(){
  
            $result_message="";
          
            // now, if ppt is not empty, try to upload the pdf
            if($this->ppt){
          
                // sha1_file() function is used to make a unique file name
                $target_directory = "ppt/";
                $target_file = $target_directory . $this->ppt;
                $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
          
                // error message is empty
                $file_upload_error_messages="";
               
                
                // make sure certain file types are allowed
                $allowed_file_types=array("ppt","pptx");
                if(!in_array($file_type, $allowed_file_types)){
                    $file_upload_error_messages.="<div>Only ppt files are allowed.</div>";
                }
                

                // If file already exist, the add timestamp to it and then save
            if(file_exists($target_file)){
                $filename = $_FILES['ppt']['name'];
            $filename = $filename.time();
                //$file_upload_error_messages.="<div>ppt already exists. Try to change file name.</div>";
            }
              
                // make sure submitted file is not too large, can't be larger than 1 MB
                if($_FILES['ppt']['size'] > (1024000)){
                    $file_upload_error_messages.="<div>ppt must be less than 1 MB in size.</div>";
                }
                
                // make sure the 'uploads' folder exists
                // if not, create it
                if(!is_dir($target_directory)){
                    mkdir($target_directory, 0777, true);
                }
        
                // if $file_upload_error_messages is still empty
                if(empty($file_upload_error_messages)){
                    // it means there are no errors, so try to upload the file
                    if(move_uploaded_file($_FILES["ppt"]["tmp_name"], $target_file)){
                        // it means photo was uploaded
                    }else{
                        $result_message.="<div class='alert alert-danger'>";
                            $result_message.="<div>Unable to upload ppt.</div>";
                            $result_message.="<div>Update the record to upload ppt.</div>";
                        $result_message.="</div>";
                    }
                }
                
                // if $file_upload_error_messages is NOT empty
                else{
                    // it means there are some errors, so show them to user
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="{$file_upload_error_messages}";
                        $result_message.="<div>Update the record to upload ppt.</div>";
                    $result_message.="</div>";
                }
          
            }
          
            return $result_message;
        }
}

//$foo = new Foo($db);
//$funcname = "Variable";
//$foo->create(); // This calls $foo->Variable()

?>