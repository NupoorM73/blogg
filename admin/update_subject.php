<?php

// get ID of the download to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Update Subject";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/subject.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$subject = new subject($db);
// set ID property of product to be edited
$subject->id = $id;
 
// read the details of product to be edited
$subject->readOne();

include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_subject.php' class='btn btn-default pull-right'>Read subject</a>
    </div>";
  
?>


<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set downloads property values
    $subject->subjectname = $_POST['subjectname'];
    $subject->level = $_POST['level'];

    $subject->id = $_POST['id'];
    // create the download
    if($subject->update())
    {        
        echo "<div class='alert alert-success'>Subject saved successfully</div>";
    }
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to update subject</div>";
    }
    // if unable to create the product, tell the user
}
?>

<!-- 'create downloads' html form will be here -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">

     
    <table class="table table-bordered table-responsive">
    
    <tr>
        <td><label class="control-label">subject ID</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='<?php echo $id ?>' type="text" name="id"  readonly /></td>
       </tr>
       <tr>
        <td><label class="control-label">subjectname</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='<?php echo $subject->subjectname; ?>' type="text" name="subjectname" required autofocus placeholder="Enter subjectname" value="" /></td>
       </tr>
       
       <tr>
       <td><label class="control-label">Level</label><b style="color:red">*</b></td>
       <td>
        <select class="form-select" aria-label="Default select example"  name="level" value='<?php echo $subject->level; ?>'>
  		    <option class="form-control" value="UG" >UG</option>
  		    <option class="form-control" value="PG" >PG</option>
        </select></td>
       </tr>
       
      
       <tr>
           <td colspan="2"><button type="submit" name="btnsave" style="background-color: blue;color:white" class="btn btn-default">
           <span class="glyphicon glyphicon-save"></span> &nbsp; Update Subject
           </button>
           </td>
       </tr>
       
       </table>
       
   </form>

<?php
  
// footer
include_once "layout_foot.php";
?>