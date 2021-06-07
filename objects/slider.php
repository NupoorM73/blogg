<?php


class slider
{
    private $conn;
    private $table_name = "img";
    public $id;
    public $image;
    public $createdon;
    public $modifiedon;

    
   
    public $softdelete;

    //public $active;
    public function __construct($db){
        $this->conn = $db;
       // echo $this->conn;
    }



    // read downloads by search term

   
    function readAll($from_record_num, $records_per_page){
 
        $query = "SELECT
                    id,image, softdelete
                FROM
                    " . $this->table_name . "
                ORDER BY createdon desc
                LIMIT
                    {$from_record_num}, {$records_per_page}";
                   
             
             //echo $query;      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    } 
    
        
    
    
    // used for paging products
    public function countAll(){
 
        $query = "SELECT id FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
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
                         image=:image, softdelete=:softdelete";
                    
        echo $query;
        

        $stmt = $this->conn->prepare($query);
        // posted values
        $this->image=htmlspecialchars(strip_tags($this->image)); 
        $this->softdelete=htmlspecialchars(strip_tags($this->softdelete));    
       
        
        $this->softdelete=1;    
        
        // bind values 
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":softdelete", $this->softdelete);
        //$stmt->bindParam(":modifiedon", $this->modifiedon);
            
        if($stmt->execute())
         {
            return true;
         }
        else{
                return false;
            }
    }
        // will upload image file to server
       // will upload image file to server
    function uploadPhoto(){
    
        $result_message="";
    
        // now, if image is not empty, try to upload the image
        if($this->image){
    
            // sha1_file() function is used to make a unique file name
            $target_directory = "img/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
    
            // error message is empty
            $file_upload_error_messages="";
            // make sure that file is a real image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
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
                $filename = $_FILES['image']['name'];
            $filename = $filename.time();
                //$file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['image']['size'] > (1024000)){
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
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
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