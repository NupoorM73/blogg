<?php

include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/blogpost.php';
include_once '../objects/image.php';
//include_once 'objects/category.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$post = new Post($db);
$img= new Image($db);


// set page headers
$page_title = "Write a Blog";

include_once "../navigation.php";

echo "<div class='col-md-12'>";
include_once "../admin/createblog.php";

 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
 
    // set product property values
     $post->title = $_POST['title'];
    $post->titledes = $_POST['titledes'];
    $imageid1=!empty($_FILES["imageid1"]["name"])? sha1_file($_FILES["imageid1"]['tmp_name']) . "-" . basename($_FILES["imageid1"]["name"]) : ""; 
        $img->imageid1 = $imageid1;
    $imageid2=!empty($_FILES["imageid2"]["name"])? sha1_file($_FILES["imageid2"]['tmp_name']) . "-" . basename($_FILES["imageid2"]["name"]) : "";
        $img->imageid2 = $imageid2;
    $imageid3=!empty($_FILES["imageid3"]["name"])? sha1_file($_FILES["imageid3"]['tmp_name']) . "-" . basename($_FILES["imageid3"]["name"]) : "";
        $img->imageid3 = $imageid3;

    $post->description = $_POST['description'];
    $post->link = $_POST['link'];
    $pdf=!empty($_FILES["pdf"]["name"])
    ? sha1_file($_FILES['pdf']['tmp_name']) . "-" . basename($_FILES["pdf"]["name"]) : "";
    $post->pdf = $pdf;
    $ppt=!empty($_FILES["ppt"]["name"])
    ? sha1_file($_FILES['ppt']['tmp_name']) . "-" . basename($_FILES["ppt"]["name"]) : "";
    $post->ppt = $ppt;
    //$post->category_id = $_POST['category_id'];
 
    // create the product
    if(($nm=$post->create())){
       // uploadPhoto() method will return an error message, if any.
       print_r($nm);
      
       // print_r(count($tmpname));
        
        
       //creating the image in the database
        $img->uploadMPhoto1($nm);
            
        //storing the image in the drive
        $img->uploadPhoto1();
        $img->uploadPhoto2();
        $img->uploadPhoto3();
    
       echo "<div class='alert alert-success'>Blog Successfully Created.</div>";

       
       echo $post->uploadPDF();
       echo $post->uploadPPT();
       
        
        // try to upload the submitted file
       
    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create the Blog.</div>";
    }
}

?>
 <div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
    <table class='table table-hover table-responsive table-bordered'>
 
     <p class="login-text" style="font-size: 2rem; font-weight: 800;">Write a Blog</p>
                
        <tr>
            <td>Title</td>
            <td><input type='text' name='title' class='form-control' required/></td>
        </tr>
 
        <tr>
            <td>Title Description</td>
            <td><input type='text' name='titledes' class='form-control' required/></td>
        </tr>
        <tr>
            <td>Image 1</td>
           <td><input type="file" name="imageid1" placeholder="Share Image" class='form-control' accept="images/*"  required/></td>
        </tr>
        <tr>
            <td>Image 2</td>
           <td><input type="file" name="imageid2" placeholder="Share Image" class='form-control' accept="images/*" required/></td>
        </tr>
        <tr>
            <td>Image 3</td>
           <td><input type="file" name="imageid3" placeholder="Share Image" class='form-control' accept="images/*" required/></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control' required></textarea></td>
        </tr>
        <tr>
            <td>Link </td>
           <td><input type="url" name="link" class='form-control' placeholder="Share Link References"/></td>
        </tr>
        <tr>
            <td>PDF </td>
           <td><input type="file" name="pdf" class='form-control' placeholder="share document" accept=".pdf"/></td>
        </tr>
        <tr>
            <td>PPT </td>
           <td><input type="file" name="ppt" class='form-control' placeholder="share document" accept=".pptx"/></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
      </table>
    
</form>
</div> 
<!-- HTML form for creating a product -->

<?php
 
// footer

?>