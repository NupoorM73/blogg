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
include_once '../objects/downloads.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objDownloads = new Downloads($db);

// set ID property of download to be read
$objDownloads->download_id=$id;

  
// read the details of download to be read
$objDownloads->readOne();
// set page header
$page_title = "Read Download";

include_once "layout_head.php";


 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='read_downloads.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Downloads";
    echo "</a>";
echo "</div>";
 
// HTML table for displaying a download details
echo "<table class='table table-hover table-responsive table-bordered'>";
  
    echo "<tr>";
        echo "<td>Title</td>";
        echo "<td>{$objDownloads->title}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Course</td>";
        echo "<td>{$objDownloads->course}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>PDF</td>";
        echo "<td>{$objDownloads->pdf}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>img</td>";
        echo "<td>{$objDownloads->img}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>PPT</td>";
        echo "<td>{$objDownloads->ppt}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Video_link</td>";
        echo "<td>{$objDownloads->video_link}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Uploaded On</td>";
        echo "<td>{$objDownloads->uploadedOn}</td>";
    echo "</tr>";
echo "</table>";
// set footer
include_once "layout_foot.php";
?>