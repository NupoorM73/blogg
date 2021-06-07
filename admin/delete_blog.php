<?php

// get ID of the download to be edited
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Delete Blog";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
// include_once '../objects/blog.php';
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
$comment = new Comment($db);
$reply = new Replies($db);
// set ID property of product to be edited
$post->post_id = $post_id;
$comment->post_id = $post_id;
$reply->post_id = $post_id;
 
// read the details of product to be edited
$post->readOne();

include_once "layout_head.php";

echo "<div class='right-button-margin'>
        <a href='read_blog.php' class='btn btn-default pull-right'>Read Blog</a>
    </div>";

?>


<?php 

  
    $post->post_id = $_GET['post_id'];
    // create the download
    if($post->delete()){
        // if($comment->delete()){
        //     if($reply->delete1())
        //     {
        //      echo "<div class='alert alert-success'></div>";
           
        //     }
        //      echo "<div class='alert alert-success'>Comment related to this post deleted successfully</div>";
        //     // header("Location: read_downloads.php");
        //  }
        echo "<div class='alert alert-success'>Post deleted successfully</div>";
       // header("Location: read_downloads.php");
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save Post</div>";
    }

?>




<?php
  
// footer
include_once "layout_foot.php";
?>