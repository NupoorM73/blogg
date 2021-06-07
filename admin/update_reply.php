<?php

// get ID of the download to be edited
$reply_id = isset($_GET['reply_id']) ? $_GET['reply_id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Add Reply";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/replies.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$reply = new Replies($db);
// set ID property of product to be edited
$reply->reply_id = $reply_id;
 


include_once "layout_head.php";

echo "<div class='right-button-margin'>
        <a href='read_replies.php' class='btn btn-default pull-right'>Read Replies</a>
    </div>";

?>


<?php 

  
    $reply->reply_id = $_GET['reply_id'];
    // create the download
    if($reply->update()){
       
        echo "<div class='alert alert-success'>Reply added successfully</div>";
       // header("Location: read_downloads.php");
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to add reply</div>";
    }

?>



