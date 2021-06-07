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
//include_once "../config/core.php";
 
// check if logged in as admin
//include_once "login_checker.php";

// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// retrieve records here
// include database and object files
// include classes

include_once 'config/database.php';
include_once 'objects/invtalks.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objinvtalks = new invtalks($db);

// set ID property of download to be read
$objinvtalks->talk_id =$id;

  
// read the details of download to be read
$objinvtalks->readOne();
// set page header
//$page_title = "Read Invited Talks";

//include_once "layout_head.php";


 
// read products button
echo "<div class='row'>";
echo "<div class='col-md-3'>";
echo "</div>";
echo "<div class='col-md-6'>";

echo "<div class='right-button-margin'>";
    echo "<a href='invitedTalks.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span>Invited Talks";
    echo "</a>";
echo "</div>";
echo"<h2>Details</h2> <hr>";
 echo"";
 
// HTML table for displaying a download details
echo "<table class='table table-hover table-responsive table-bordered'>";
  
    echo "<tr>";
        echo "<td>title</td>";
        echo "<td>{$objinvtalks->title}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>organizedby</td>";
        echo "<td>{$objinvtalks->organizedby}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>level</td>";
        echo "<td>{$objinvtalks->level}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>type</td>";
        echo "<td>{$objinvtalks->type}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>fromdate</td>";
        echo "<td>{$objinvtalks->fromdate}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>todate</td>";
        echo "<td>{$objinvtalks->todate}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Duration</td>";
        echo "<td>{$objinvtalks->Duration}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>unit</td>";
        echo "<td>{$objinvtalks->unit}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>certificate</td>";
        echo "<td><a href='admin/pdf/{$objinvtalks->certificate}' target='_blank'>Download</a></td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>schedule</td>";
        echo "<td><a href='admin/pdf/{$objinvtalks->schedule}' target='_blank'>Download</a></td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>photo1</td>";
        echo "<td width='10%'><a href='admin/img/{$objinvtalks->photo1}' target='_blank'><img src='admin/img/{$objinvtalks->photo1}' style='width:30%;'></a></td>";
       // echo "<td>{$objinvtalks->photo1}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>photo2</td>";
        echo "<td width='10%'><a href='admin/img/{$objinvtalks->photo2}' target='_blank'><img src='admin/img/{$objinvtalks->photo2}' style='width:30%;'></a></td>";
        //echo "<td>{$objinvtalks->photo2}</td>";
    echo "</tr>";
echo "</table>";
echo "<div class='col-md-3'>";
echo "</div>";
echo "</div>";
echo "</div>";

// set footer
//include_once "layout_foot.php";
?>