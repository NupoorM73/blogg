<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";

// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// retrieve records here
// include database and object files
// include classes

include_once '../config/database.php';
include_once '../objects/subject.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objsubject = new subject($db);

// set ID property of download to be read
$objsubject->id=$id;

  
// read the details of download to be read
$objsubject->readOne();
// set page header
$page_title = "Read subject";

include_once "layout_head.php";


 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='read_subject.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read subject";
    echo "</a>";
echo "</div>";
 
// HTML table for displaying a download details
echo "<table class='table table-hover table-responsive table-bordered'>";
  
    echo "<tr>";
        echo "<td>subjectname</td>";
        echo "<td>{$objsubject->subjectname}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>level</td>";
        echo "<td>{$objsubject->level}</td>";
    echo "</tr>";
  
    
echo "</table>";
// set footer
include_once "layout_foot.php";
?>

<!--<td><label class="control-label">Level</label><b style="color:red">*</b></td>
       <td>
        <select class="form-select" aria-label="Default select example" >
  		    <option class="form-control"  value='<?php echo $subject->level; ?>' name="level" >UG</option>
  		    <option class="form-control"  value='<?php echo $subject->level; ?>' name="level">PG</option>
        </select></td>-->