<?php

// get ID of the download to be edited
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Update Blog";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/blogpost.php';
include_once '../objects/comments.php';
include_once '../objects/user.php';
include_once '../objects/replies.php';
include_once '../objects/image.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$post = new Post($db);
$img = new Image($db);
// set ID property of product to be edited
$post->post_id = $post_id;
$img->post_id = $post_id;
 
// read the details of product to be edited
$post->readOne();

include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_blog.php' class='btn btn-default pull-right'>Read Blog</a>
    </div>";
  
?>


<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set downloads property values
    $post->title = $_POST['title'];
    $post->titledes = $_POST['titledes'];


    $imageid1=!empty($_FILES["imageid1"]["name"])? sha1_file($_FILES["imageid1"]['tmp_name']) . "-" . basename($_FILES["imageid1"]["name"]) : ""; 
        $img->imageid1 = $imageid1;
    $imageid2=!empty($_FILES["imageid2"]["name"])? sha1_file($_FILES["imageid2"]['tmp_name']) . "-" . basename($_FILES["imageid2"]["name"]) : "";
        $img->imageid2 = $imageid2;
    $imageid3=!empty($_FILES["imageid3"]["name"])? sha1_file($_FILES["imageid3"]['tmp_name']) . "-" . basename($_FILES["imageid3"]["name"]) : "";
        $img->imageid3 = $imageid3;



    $post->publicationdate = $_POST['publicationdate'];
    $post->description = $_POST['description'];
    $post->link = $_POST['link'];
    $post->pdf = !empty($_FILES["pdf"]["name"])
    ? sha1_file($_FILES['pdf']['tmp_name']) . "-" . basename($_FILES["pdf"]["name"]) : "";

    // $post->img = !empty($_FILES["img"]["name"])
    // ? sha1_file($_FILES['img']['tmp_name']) . "-" . basename($_FILES["img"]["name"]) : "";
   
   
    $post->ppt = !empty($_FILES["ppt"]["name"])
    ? sha1_file($_FILES['ppt']['tmp_name']) . "-" . basename($_FILES["ppt"]["name"]) : "";
    
    $post->created = $_POST['created'];
    $post->modified = $_POST['modified'];
    // create the download
    if($nm = $post->update()){
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        $img->uploadMPhoto1($nm);
            
        //storing the image in the drive
        $img->uploadPhoto1();
        $img->uploadPhoto2();
        $img->uploadPhoto3();
        echo "<div class='alert alert-success'>Blog Updated successfully</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to Update</div>";
    }
}
?>

<!-- 'create downloads' html form will be here -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?post_id={$post_id}");?>" method="post">

     
    <table class="table table-bordered table-responsive">
    
       <tr>
        <td><label class="control-label">Title</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='<?php echo $post->title; ?>' type="text" name="title" required autofocus placeholder="Title" value="" /></td>
       </tr>
       
       <tr>
        <td><label class="control-label">Title Description</label></td>
           <td><input class="form-control" value='<?php echo $post->titledes; ?>' type="text" name="titledes" placeholder="Title Description" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Image 1</label></td>
           <td><input class="form-control" value='<?php echo $img->imageid1; ?>' type="file" name="imageid1" placeholder="Update Image" value="" accept="images/*" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Image 2</label></td>
           <td><input class="form-control" value='<?php echo $img->imageid2; ?>' type="file" name="imageid2" placeholder="Update Image" value="" accept="images/*" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Image 3</label></td>
           <td><input class="form-control" value='<?php echo $img->imageid3; ?>' type="file" name="imageid3" placeholder="Update Image" value="" accept="images/*"/></td>
       </tr>




       <!-- <tr>
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
        </tr> -->
       

       <tr>
        <td><label class="control-label">Publication Date</label></td>
           <td><input class="form-control" value='<?php echo $post->publicationdate; ?>' type="text" name="publicationdate" placeholder="Publication Date" value="" /></td>
       </tr>
    

       <tr>
        <td><label class="control-label">Description</label></td>
           <td><input class="form-control" value='<?php echo $post->description; ?>' type="text" name="description" placeholder="Description" value="" /></td>
       </tr>
      

       <tr>
        <td><label class="control-label">Link</label></td>
           <td><input class="form-control" value='<?php echo $post->link; ?>' type="text" name="link" placeholder="Link" value="" /></td>
       </tr>
      
        
       <tr>
        <td><label class="control-label">Upload PDF</label></td>
           <td><input class="input-group" value='<?php echo $post->pdf; ?>' type="file" name="pdf" accept=".pdf" />
           <a href='uploads/pdf/<?php echo $post->pdf ?>' target='_blank'><?php echo $post->pdf ?></a>
           </td>
       </tr>
       <tr>
        <td><label class="control-label">Upload PPT</label></td>
           <td><input class="input-group" type="file"  name="ppt" accept=".pptx, .ppt" />
           <a href='uploads/ppt/<?php echo $post->ppt ?>' target='_blank'><?php echo $post->ppt ?></a>
           </td>
       </tr>
       <!-- <tr>
        <td><label class="control-label">Upload image</label></td>
           <td><input class="input-group" type="file" name="img" accept="image/*" />
           <img src="img/" width="10%" alt=""></td>
       </tr> -->
       <tr>
        <td><label class="control-label">Created</label></td>
           <td><input class="form-control" value='<?php echo $post->created; ?>' type="text" name="created" placeholder="Created" value="" /></td>
       </tr>
       <tr>

       <tr>
        <td><label class="control-label">Modified</label></td>
           <td><input class="form-control" value='<?php echo $post->modified; ?>' type="text" name="modified" placeholder="Modified" value="" /></td>
       </tr>
       <tr>
      
       <tr>
           <td colspan="2"><button type="submit" name="btnsave" style="background-color: blue;color:white" class="btn btn-default">
           <span class="glyphicon glyphicon-save"></span> &nbsp; Save Blog
           </button>
           </td>
       </tr>
       
       </table>
       
   </form>

<?php
  
// footer
include_once "layout_foot.php";
?>