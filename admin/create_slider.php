<?php
// set page headers

// core configuration
include_once "../config/core.php";
include_once "../config/database.php";
// set page title
$page_title = "Upload Image";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/slider.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$slider = new slider($db);

$page_title = "Upload Image";
include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_slider.php' class='btn btn-default pull-right'>Read slider</a>
    </div>";
  
?>
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST)
{  
    $slider->image = !empty($_FILES["image"]["name"])
    ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) :"";
    //echo $slider->image;
     
    if($slider->create()){
         
        echo $slider->uploadPhoto();
        echo "<div class='alert alert-success'>upload saved successfully</div>";
    }
    else{
        echo "<div class='alert alert-danger'>Unable to upload 1 1 </div>";
    }
}
?>

<!-- 'create downloads' html form will be here -->
<form method="post" enctype="multipart/form-data" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     
    <table class="table table-bordered table-responsive">
    
       
       <tr>
        <td><label class="control-label">Upload image</label></td>
           <td><input class="input-group" type="file" name="image" accept="image/*" /></td>
       </tr>
      
      
       <tr>
           <td colspan="2"><button type="submit" name="btnsave" style="background-color: blue;color:white" class="btn btn-default">
           <span class="glyphicon glyphicon-save"></span> &nbsp; Save Upload
           </button>
           </td>
       </tr>
       
       </table>
       
   </form>

<?php
  
// footer
include_once "layout_foot.php";
?>