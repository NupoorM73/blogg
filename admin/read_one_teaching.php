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
include_once '../objects/teaching.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objteaching = new teaching($db);

// set ID property of download to be read
$objteaching->id=$id;

  
// read the details of download to be read
$objteaching->readOne();
// set page header
$page_title = "Read Teaching";

include_once "layout_head.php";


 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='read_teaching.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read teaching";
    echo "</a>";
echo "</div>";
 
// HTML table for displaying a download details
echo "<table class='table table-hover table-responsive table-bordered'>";
  
    echo "<tr>";
        echo "<td>Title</td>";
        echo "<td>{$objteaching->title}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Organized By</td>";
        echo "<td>{$objteaching->organized_by}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Level</td>";
        echo "<td>{$objteaching->level}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>From Date</td>";
        echo "<td>{$objteaching->from_date}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>To Date</td>";
        echo "<td>{$objteaching->to_date}</td>";
    echo "</tr>";
    
    echo "<tr>";
        echo "<td>Duration</td>";
        echo "<td>{$objteaching->duration}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>certificate</td>";
        echo "<td>{$objteaching->certificate}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>schedule</td>";
        echo "<td>{$objteaching->schudule}</td>";
    echo "</tr>";
        echo "<tr>";
        echo "<td>photo1</td>";
    echo "<td>{$objteaching->photo1}</td>";
    echo "</tr>";
        echo "<tr>";
        echo "<td>photo2</td>";
    echo "<td>{$objteaching->photo2}</td>";
    echo "</tr>";
    
    echo "</table>";
// set footer
include_once "layout_foot.php";
?>