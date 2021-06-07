<?php

// get ID of the download to be edited
$comment_id = isset($_GET['comment_id']) ? $_GET['comment_id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Add Comment";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/comments.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$comment = new Comment($db);
// set ID property of product to be edited
$comment->comment_id = $comment_id;
 
// read the details of product to be edited
//$reply->readOne();

include_once "layout_head.php";

echo "<div class='right-button-margin'>
        <a href='read_comm.php' class='btn btn-default pull-right'>Read comments</a>
    </div>";

?>


<?php 

  
    $comment->comment_id = $_GET['comment_id'];
    // create the download
    if($comment->update()){
       
        echo "<div class='alert alert-success'>Comment added successfully</div>";
       // header("Location: read_downloads.php");
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to added comment</div>";
    }

?>
