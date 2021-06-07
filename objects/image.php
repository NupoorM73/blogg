<?php
class Image{
    // database connection and table name
    private $conn;
    public $table_name = "image";

    // object properties
    public $id;
    public $imageid1;
    public $imageid2;
    public $imageid3;
    public $post_id;
    public $email;
    public $status;

    public function __construct($db){
        $this->conn = $db;
    }
    
function uploadMPhoto1($nm){
    
     //write query
     $this->post_id=$nm;
     $query = "INSERT INTO
     " . $this->table_name . "
 SET

 imageid1=:imageid1,imageid2=:imageid2,imageid3=:imageid3,post_id=:post_id,email=:email,
       status=1";

$stmt = $this->conn->prepare($query);


$this->imageid1=htmlspecialchars(($this->imageid1));
$this->imageid2=htmlspecialchars(($this->imageid2));
$this->imageid3=htmlspecialchars(($this->imageid3));
$this->post_id=htmlspecialchars(($this->post_id));



// to get time-stamp for 'created' field
$this->timestamp = date('Y-m-d');

// bind values 
$stmt->bindParam(":imageid1", $this->imageid1);
$stmt->bindParam(":imageid2", $this->imageid2);
$stmt->bindParam(":imageid3", $this->imageid3);
$stmt->bindParam(":post_id", $this->post_id);
$stmt->bindParam(":email", $_SESSION['email']);

if($stmt->execute()){
return true;
}else{
return false;
}

}
    
    function uploadPhoto1(){
 
        $result_message="";
        
        
    
        // now, if image is not empty, try to upload the image
    
        if($this->imageid1){
     
            // sha1_file() function is used to make a unique file name
            $target_directory = "../uploads/image/";
            $target_file = $target_directory . $this->imageid1;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
     
            // error message is empty
            $file_upload_error_messages="";
            // make sure that file is a real image
    $check = filesize($_FILES["imageid1"]["tmp_name"]);
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
     
    // make sure file does not exist
    if(file_exists($target_file)){
        $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
    }
     
    // make sure submitted file is not too large, can't be larger than 1 MB
    if($_FILES['imageid1']['size'] > (5024000)){
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
        if(move_uploaded_file($_FILES["imageid1"]["tmp_name"], $target_file)){
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
    return $result_message;
        }
    
}
function uploadPhoto2()
{
    $result_message2="";

    if($this->imageid2){
     
        // sha1_file() function is used to make a unique file name
        $target_directory = "../uploads/image/";
        $target_file = $target_directory . $this->imageid2;
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
 
        // error message is empty
        $file_upload_error_messages="";
        // make sure that file is a real image
$check = filesize($_FILES["imageid2"]["tmp_name"]);
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
 
// make sure file does not exist
if(file_exists($target_file)){
    $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
}
 
// make sure submitted file is not too large, can't be larger than 1 MB
if($_FILES['imageid2']['size'] > (5024000)){
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
    if(move_uploaded_file($_FILES["imageid2"]["tmp_name"], $target_file)){
        // it means photo was uploaded
    }else{
        $result_message2.="<div class='alert alert-danger'>";
            $result_message2.="<div>Unable to upload photo.</div>";
            $result_message2.="<div>Update the record to upload photo.</div>";
        $result_message2.="</div>";
    }
}
 
// if $file_upload_error_messages is NOT empty
else{
    // it means there are some errors, so show them to user
    $result_message2.="<div class='alert alert-danger'>";
        $result_message2.="{$file_upload_error_messages}";
        $result_message2.="<div>Update the record to upload photo.</div>";
    $result_message2.="</div>";
}
return $result_message2;
    }
}
function uploadPhoto3()
{
    $result_message3="";

    if($this->imageid3){
     
        // sha1_file() function is used to make a unique file name
        $target_directory = "../uploads/image/";
        $target_file = $target_directory . $this->imageid3;
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
 
        // error message is empty
        $file_upload_error_messages="";
        // make sure that file is a real image
$check = filesize($_FILES["imageid3"]["tmp_name"]);
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
 
// make sure file does not exist
if(file_exists($target_file)){
    $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
}
 
// make sure submitted file is not too large, can't be larger than 1 MB
if($_FILES['imageid1']['size'] > (5024000)){
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
    if(move_uploaded_file($_FILES["imageid3"]["tmp_name"], $target_file)){
        // it means photo was uploaded
    }else{
        $result_message3.="<div class='alert alert-danger'>";
            $result_message3.="<div>Unable to upload photo.</div>";
            $result_message3.="<div>Update the record to upload photo.</div>";
        $result_message3.="</div>";
    }
}
 
// if $file_upload_error_messages is NOT empty
else{
    // it means there are some errors, so show them to user
    $result_message3.="<div class='alert alert-danger'>";
        $result_message3.="{$file_upload_error_messages}";
        $result_message3.="<div>Update the record to upload photo.</div>";
    $result_message3.="</div>";
}
return $result_message3;
    } 
}
function readAll(){
 
    $query = "SELECT
                image.imageid1
            FROM
                " . $this->table_name . "
             " ;
            
 
    $stmttt = $this->conn->prepare( $query );
    $stmttt->execute();
 
    return $stmttt;
}
function readOne(){
 
    $query = "SELECT
                imageid1,imageid2,imageid3
            FROM
                " . $this->table_name . "  
                WHERE status=1 AND post_id=?               
            ORDER BY
                email ASC
            " ;
 
    $stmtt = $this->conn->prepare( $query );
    $stmtt->bindParam(1,$this->post_id);
    $stmtt->execute();
     
  return $stmtt;
}
    
}

    
    

?>