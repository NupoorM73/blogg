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
include_once '../objects/roles_responsibility.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objrolres = new rolres($db);

// set ID property of download to be read
$objrolres->role_id =$id;

  
// read the details of download to be read
$objrolres->readOne();
// set page header
$page_title = "Read Roles & Responsibility";

include_once "layout_head.php";


 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='read_roles_responsibility.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Roles & Responsibility";
    echo "</a>";
echo "</div>";
 
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
        echo "<td>{$objrolres->letter_appointment}</td>";
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
        echo "<td>{$objrolres->report_task}</td>";
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
// set footer
include_once "layout_foot.php";
?>