<?php

// get ID of the download to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Delete Roles & Responsibility";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/roles_responsibility.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$rolres = new rolres($db);
// set ID property of product to be edited
$rolres->role_id = $id;
 
// read the details of product to be edited
$rolres->readOne();

include_once "layout_head.php";

echo "<div class='right-button-margin'>
        <a href='read_roles_responsibility.php' class='btn btn-default pull-right'>Read Roles & Responsibility</a>
    </div>";

?>


<?php 

    $rolres->role_id = $_GET['id'];
    // create the download
    if($rolres->delete()){
       
        echo "<div class='alert alert-success'>Roles & Responsibility deleted successfully</div>";
       // header("Location: read_downloads.php");
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save Roles & Responsibility</div>";
    }

?>




<?php
  
// footer
include_once "layout_foot.php";
?>