<?php
// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Add Downloads";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/downloads.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$downloads = new Downloads($db);

$page_title = "Create Download";
include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_downloads.php' class='btn btn-default pull-right'>Read Downloads</a>
    </div>";
  
?>
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set downloads property values
    $downloads->title = $_POST['title'];
    $downloads->course = $_POST['course'];
    $downloads->pdf = !empty($_FILES["pdf"]["name"])
    ? sha1_file($_FILES['pdf']['tmp_name']) . "-" . basename($_FILES["pdf"]["name"]) : "";

    $downloads->img = !empty($_FILES["img"]["name"])
    ? sha1_file($_FILES['img']['tmp_name']) . "-" . basename($_FILES["img"]["name"]) : "";
   
   
    $downloads->ppt = !empty($_FILES["ppt"]["name"])
    ? sha1_file($_FILES['ppt']['tmp_name']) . "-" . basename($_FILES["ppt"]["name"]) : "";
    $downloads->video_link = $_POST['video_link'];


    // create the download
    if($downloads->create()){
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $downloads->uploadPhoto();

        echo $downloads->uploadPdf();

        echo $downloads->uploadPpt();
        echo "<div class='alert alert-success'>Dowanload saved successfully</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save download</div>";
    }
}
?>

<!-- 'create downloads' html form will be here -->
<form method="post" enctype="multipart/form-data" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     
    <table class="table table-bordered table-responsive">
    
       <tr>
        <td><label class="control-label">Title</label><b style="color:red">*</b></td>
           <td><input class="form-control" type="text" name="title" required autofocus placeholder="Enter Title" value="" /></td>
       </tr>
       
       <tr>
        <td><label class="control-label">Course</label></td>
           <td><input class="form-control" type="text" name="course" placeholder="Enter Course" value="" /></td>
       </tr>
       <tr>
        
       <tr>
        <td><label class="control-label">Upload PDF</label></td>
           <td><input class="input-group" type="file" name="pdf" accept=".pdf" /></td>
       </tr>
       <tr>
        <td><label class="control-label">Upload PPT</label></td>
           <td><input class="input-group" type="file" name="ppt" accept=".pptx, .ppt" /></td>
       </tr>
       <tr>
        <td><label class="control-label">Upload image</label></td>
           <td><input class="input-group" type="file" name="img" accept="image/*" /></td>
       </tr>
       <tr>
        <td><label class="control-label">VideoLink</label></td>
           <td><input class="form-control" type="text" name="video_link" placeholder="Enter Video Link" value="" /></td>
       </tr>
      
       <tr>
           <td colspan="2"><button type="submit" name="btnsave" style="background-color: blue;color:white" class="btn btn-default">
           <span class="glyphicon glyphicon-save"></span> &nbsp; Save Download
           </button>
           </td>
       </tr>
       
       </table>
       
   </form>

<?php
  
// footer
include_once "layout_foot.php";
?>