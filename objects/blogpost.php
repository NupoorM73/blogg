<?php

class Post{
    // database connection and table name
    private $conn;
    public $table_name = "blogpost";

    // object properties
    public $email;
    public $post_id;
    public $title;
    public $titledes;
    public $publicationdate;
    public $description;
    public $link;
    public $pdf;
    public $ppt;
    public $created;
    public $modified;
    public $softdelete;

    public function __construct($db){
        $this->conn = $db;
    }



    // create post
    function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    email=:email,title=:title, 
                    titledes=:titledes,
                    publicationdate=:publicationdate, 
                    description=:description, link=:link, 
                    pdf=:pdf, ppt=:ppt, created=:created, 
                    modified=:modified, softdelete = 1 
                     ";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->titledes=htmlspecialchars(strip_tags($this->titledes));
        //$this->imageid=htmlspecialchars(strip_tags($this->imageid));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->link=htmlspecialchars(strip_tags($this->link));
        $this->pdf=htmlspecialchars(strip_tags($this->pdf));
        $this->ppt=htmlspecialchars(strip_tags($this->ppt));
        $this->created=date('Y-m-d');
        $this->modified = date('Y-m-d');

       
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d');
 
        // bind values 
        $stmt->bindParam("email",$_SESSION['email'] );
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":titledes", $this->titledes);
        $stmt->bindParam(":publicationdate", $this->timestamp);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":link", $this->link);
        $stmt->bindParam(":pdf", $this->pdf);
        $stmt->bindParam(":ppt", $this->ppt);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":modified", $this->timestamp);
        
    

        if($stmt->execute()){
            $query1="SELECT post_id  FROM " . $this->table_name ." ORDER BY post_id DESC LIMIT 1 ";
            $stmt1 = $this->conn->prepare($query1);
           
            $nm = $stmt1->execute();
            return $nm ;
        }else{
            return false;
        }
    }

// will upload image file to server

// will upload pdf file to server
function uploadPDF(){
 
    $result_message1="";
 
    // now, if image is not empty, try to upload the image
    if($this->pdf){
 
        // sha1_file() function is used to make a unique file name
        $target_directory = "../uploads/pdf/";
        $target_file = $target_directory . $this->pdf;
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
 
        // error message is empty
        $file_upload_error_messages1="";
        // make sure that file is a real image
$check = filesize($_FILES["pdf"]["tmp_name"]);
if($check!==false){
    // submitted file is an image
}else{
    $file_upload_error_messages1.="<div>Submitted file is not a PDF.</div>";
}
 
// make sure certain file types are allowed
$allowed_file_types=array("pdf");
if(!in_array($file_type, $allowed_file_types)){
    $file_upload_error_messages1.="<div>Only PDF file is allowed.</div>";
}
 
// make sure file does not exist
if(file_exists($target_file)){
    $file_upload_error_messages1.="<div>PDF already exists. Try to change file name.</div>";
}
 
// make sure submitted file is not too large, can't be larger than 1 MB
if($_FILES['pdf']['size'] > (5024000)){
    $file_upload_error_messages1.="<div>PDF must be less than 5 MB in size.</div>";
}
 
// make sure the 'uploads' folder exists
// if not, create it
if(!is_dir($target_directory)){
    mkdir($target_directory, 0777, true);
}
// if $file_upload_error_messages is still empty
if(empty($file_upload_error_messages1)){
    // it means there are no errors, so try to upload the file
    if(move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file)){
        // it means photo was uploaded
    }else{
        $result_message1.="<div class='alert alert-danger'>";
            $result_message1.="<div>Unable to upload PDF.</div>";
            $result_message1.="<div>Update the record to upload PDF.</div>";
        $result_message1.="</div>";
    }
}
 
// if $file_upload_error_messages is NOT empty
else{
    // it means there are some errors, so show them to user
    $result_message1.="<div class='alert alert-danger'>";
        $result_message1.="{$file_upload_error_messages1}";
        $result_message1.="<div>Update the record to upload PDF.</div>";
    $result_message1.="</div>";
}
 
    }
 
    return $result_message1;
}




// will upload ppt file to server
function uploadPPT(){
 
    $result_message2="";
 
    // now, if image is not empty, try to upload the image
    if($this->ppt){
 
        // sha1_file() function is used to make a unique file name
        $target_directory = "../uploads/ppt/";
        $target_file = $target_directory . $this->ppt;
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
 
        // error message is empty
        $file_upload_error_messages2="";
        // make sure that file is a real image
$check = filesize($_FILES["ppt"]["tmp_name"]);
if($check!==false){
    // submitted file is an image
}else{
    $file_upload_error_messages2.="<div>Submitted file is not a PPT.</div>";
}
 
// make sure certain file types are allowed
$allowed_file_types=array("pptx");
if(!in_array($file_type, $allowed_file_types)){
    $file_upload_error_messages2.="<div>Only PPT file is allowed.</div>";
}
 
// make sure file does not exist
if(file_exists($target_file)){
    $file_upload_error_messages2.="<div>PPT already exists. Try to change file name.</div>";
}
 
// make sure submitted file is not too large, can't be larger than 1 MB
if($_FILES['ppt']['size'] > (5024000)){
    $file_upload_error_messages2.="<div>PPT must be less than 5 MB in size.</div>";
}
 
// make sure the 'uploads' folder exists
// if not, create it
if(!is_dir($target_directory)){
    mkdir($target_directory, 0777, true);
}
// if $file_upload_error_messages is still empty
if(empty($file_upload_error_messages2)){
    // it means there are no errors, so try to upload the file
    if(move_uploaded_file($_FILES["ppt"]["tmp_name"], $target_file)){
        // it means photo was uploaded
    }else{
        $result_message2.="<div class='alert alert-danger'>";
            $result_message2.="<div>Unable to upload PPT.</div>";
            $result_message2.="<div>Update the record to upload PPT.</div>";
        $result_message2.="</div>";
    }
}
 
// if $file_upload_error_messages is NOT empty
else{
    // it means there are some errors, so show them to user
    $result_message2.="<div class='alert alert-danger'>";
        $result_message2.="{$file_upload_error_messages2}";
        $result_message2.="<div>Update the record to upload PPT.</div>";
    $result_message2.="</div>";
}
 
    }
 
    return $result_message2;
}

function readAll($from_record_num, $records_per_page){
 
    $query = "SELECT
                post_id,email,title,titledes,publicationdate,description,link,pdf,ppt,created,modified
            FROM
                " . $this->table_name . "
                WHERE softdelete =1
            ORDER BY
                email ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}
public function countAll(){
 
    $query = "SELECT post_id  FROM " . $this->table_name ." ";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    $num = $stmt->rowCount();
 
    return $num;
}

function delete(){
 
    $query = "UPDATE " . $this->table_name . " SET softdelete = 0 WHERE post_id = ?";
     
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->post_id);
 
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
function update(){
 
    $query = "UPDATE
                " . $this->table_name . "
            SET
                    email = :email,
                    title = :title, 
                    titledes=:titledes,
                    publicationdate=:publicationdate, 
                    description=:description, link=:link, 
                    pdf=:pdf, ppt=:ppt, created=:created, 
                    modified=:modified, softdelete=1
            WHERE
                post_id = :post_id";
 
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->post_id=htmlspecialchars(strip_tags($this->post_id));
    $this->title=htmlspecialchars(strip_tags($this->title));
        $this->titledes=htmlspecialchars(strip_tags($this->titledes));
        $this->publicationdate=htmlspecialchars(strip_tags($this->publicationdate));
        //$this->imageid=htmlspecialchars(strip_tags($this->imageid));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->link=htmlspecialchars(strip_tags($this->link));
        $this->pdf=htmlspecialchars(strip_tags($this->pdf));
        $this->ppt=htmlspecialchars(strip_tags($this->ppt));
        $this->created=date('Y-m-d');
 
    // to get time-stamp for 'created' field
    $this->timestamp = date('Y-m-d');
 
    // bind values 
    $stmt->bindParam(":post_id", $this->post_id);
    $stmt->bindParam("email",$_SESSION['email'] );
   
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":titledes", $this->titledes);
    $stmt->bindParam(":publicationdate", $this->timestamp);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":link", $this->link);
    $stmt->bindParam(":pdf", $this->pdf);
    $stmt->bindParam(":ppt", $this->ppt);
    $stmt->bindParam(":created", $this->created);
    $stmt->bindParam(":modified", $this->timestamp);
    
    // execute the query
    if($stmt->execute()){
        $query1="SELECT post_id FROM  " . $this->table_name . "";
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->execute();
        $nm = $stmt1->rowCount();
        return $nm ;
    }
 
    return false;
     
}

public function search($search_term, $from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT
                email, title, titledes, description,created
            FROM
                " . $this->table_name . " 
            WHERE
            email like ? or title like ? or titledes like ? or description like ? 
            ORDER BY
                created ASC
            LIMIT
                ?, ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
    $stmt->bindParam(3, $search_term);
    $stmt->bindParam(4, $search_term);
    $stmt->bindParam(5, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(6, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}
public function countAll_BySearch($search_term){
 
    // select query
    $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . "  
            WHERE
            email like ? or title like ? or titledes like ? or description like ? ";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
    $stmt->bindParam(3, $search_term);
    $stmt->bindParam(4, $search_term);
 
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    return $row['total_rows'];
}
function readOne(){
 
    $query = "SELECT
                 email,title,titledes,publicationdate, description,link,pdf,ppt, created, modified
            FROM " . $this->table_name . "
            WHERE
                post_id = ?
            LIMIT
                0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->post_id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->email = $row['email'];
    $this->title = $row['title'];
    $this->titledes = $row['titledes'];
    $this->publicationdate = $row['publicationdate'];
    $this->description = $row['description'];
    $this->link = $row['link'];
    $this->pdf = $row['pdf'];
    $this->ppt = $row['ppt'];
    $this->created = $row['created'];
    $this->modified = $row['modified'];

    

}
function readPAll($from_record_num, $records_per_page){
 
    $query = "SELECT
                post_id,title,imageid,publicationdate,description
            FROM
                ' . $this->table_name . '
            WHERE email = ?
            LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmtp = $this->conn->prepare( $query );
    $stmtp->bindParam(1,$this->user_id);
    $stmtp->execute();
    $rows1= $stmtp->fetch(PDO::FETCH_ASSOC);

    $this->title = $rows1['title'];
    $this->titledes = $rows1['titledes'];
    $this->imageid = $rows1['imageid'];
    $this->publicationdate = $rows1['publicationdate'];
    $this->link = $rows1['link'];
    $this->pdf = $rows1['pdf'];
    $this->ppt = $rows1['ppt'];

 
    return $stmtp;
}
public function countIAll(){
    // $user=$_SESSION['user_id'];
    // $query = "SELECT post_id  FROM " . $this->table_name ." WHERE user_id=$user ";
 
    // $stmt = $this->conn->prepare( $query );
    // $stmt->execute();
 
    // $num = $stmt->rowCount();
 
    // return $num;
}
}


?>