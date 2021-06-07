<?php

// get ID of the download to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Delete Subject";
 
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
        <a href='read_subject.php' class='btn btn-default pull-right'>Read Subject</a>
    </div>";

?>


<?php 

  
    $subject->id = $_GET['id'];
    // create the download
    if($subject->delete()){
       
        echo "<div class='alert alert-success'>Subject deleted successfully</div>";
       // header("Location: read_downloads.php");
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save subject</div>";
    }

?>




<?php
  
// footer
include_once "layout_foot.php";
?>