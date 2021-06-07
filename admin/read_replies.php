<?php
// core configuration
include_once "../config/core.php";

 
// check if logged in as admin
include_once "login_checker.php";

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// retrieve records here
// include database and object files
// include classes
include_once '../config/database.php';
include_once '../objects/blogpost.php';
include_once '../objects/comments.php';
include_once '../objects/user.php';
include_once '../objects/replies.php';
include_once '../objects/image.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$post = new Post($db);
$img = new Image($db);
$comment = new Comment($db);
$reply = new Replies($db);


// set page header
$page_title = "Replies";

include_once "layout_head.php";


echo "<div class='col-md-12'>"; 

    // query products
    $stmt = $reply->readAll($from_record_num, $records_per_page);
    $num = $stmt->rowCount();
     //echo $num;
    
    $total_rows=$num;
     // count retrieved users
        $num = $stmt->rowCount();
     
        // to identify page for paging
        $page_url="read_replies.php?";
     
        // include downloads table HTML template
        include_once "read_replies_template.php";
    
    
echo "</div>";

// set page footer
include_once "layout_foot.php";
?>