<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "Store Admin"; ?></title>
 
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />
 
    <!-- admin custom CSS -->
    <link href="<?php echo $home_url . "libs/css/admin.css" ?>" rel="stylesheet" />
    <link href="<?php echo $home_url . "style.css" ?>" rel="stylesheet" />
</head>
<br><br>
<?php
// core configuration
////include_once "../config/core.php";
 
// check if logged in as admin
//include_once "login_checker.php";

// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// retrieve records here
// include database and object files
// include classes

include_once 'config/database.php';
include_once 'objects/roles_responsibility.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objrolres = new rolres($db);

// set ID property of download to be read
$objrolres->role_id =$id;

  
// read the details of download to be read
$objrolres->readOne();
// set page header
//$page_title = "Read Roles & Responsibility";

//include_once "layout_head.php";


 
// read products button
echo "<div class='row'>";
echo "<div class='col-md-3'>";
echo "</div>";
echo "<div class='col-md-6'>";
//echo "<h2>Details</h2>";
echo "<div class='right-button-margin'>";
    echo "<a href='roles.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span>Roles & Responsibility";
    echo "</a>";
echo "</div>";
echo"<h2>Details</h2> <hr>";
 echo"";
 
// HTML table for displaying a download details
echo "<table class='table table-hover table-responsive table-bordered'>";

    echo "<tr>";
        echo "<td>Name of committee</td>";
        echo "<td>{$objrolres->name_commitee}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Role</td>";
        echo "<td>{$objrolres->role}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Level</td>";
        echo "<td>{$objrolres->level}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Academic year</td>";
        echo "<td>{$objrolres->academic_year}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Name of Event</td>";
        echo "<td>{$objrolres->name_event}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Letter of Appointment</td>";
        echo "<td><a href='admin/pdf/{$objrolres->letter_appointment}' target='_blank'>Download</a></td>";
    echo "</tr>";


    echo "<tr>";
        echo "<td>Date of Appointment</td>";
        echo "<td>{$objrolres->date_appointment}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Descrption of Role</td>";
        echo "<td>{$objrolres->desc_role}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Report of Task completed</td>";
        echo "<td><a href='admin/pdf/{$objrolres->report_task}' target='_blank'>Download</a></td>";
    echo "</tr>";
    
    echo "<tr>";
        echo "<td>Createdby</td>";
        echo "<td>{$objrolres->createdby}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Modifiedby</td>";
        echo "<td>{$objrolres->modifiedby}</td>";
    echo "</tr>";


    echo "</table>";
    echo "<div class='col-md-3'>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
// set footer
//include_once "layout_foot.php";
?>