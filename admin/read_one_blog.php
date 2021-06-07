<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";

// get ID of the product to be read
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die('ERROR: missing ID.');

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

// set ID property of download to be read
$post->post_id=$post_id;

  
// read the details of download to be read
$post->readOne();
// set page header
$page_title = "Read Blog";

include_once "layout_head.php";


 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='read_blog.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span>Read Blog";
    echo "</a>";
echo "</div>";
 
// HTML table for displaying a download details
echo "<table class='table table-hover table-responsive table-bordered'>";
  
    echo "<tr>";
        echo "<td>Title</td>";
        echo "<td>{$post->title}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Title description</td>";
        echo "<td>{$post->titledes}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Publication Date</td>";
        echo "<td>{$post->publicationdate}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Description</td>";
        echo "<td>{$post->description}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Link</td>";
        echo "<td>{$post->link}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>PDF</td>";
        echo "<td>{$post->pdf}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>PPT</td>";
        echo "<td>{$post->ppt}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Created</td>";
        echo "<td>{$post->created}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Modified</td>";
        echo "<td>{$post->modified}</td>";
    echo "</tr>";

echo "</table>";
// set footer
include_once "layout_foot.php";
?>