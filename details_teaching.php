<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <!-- set the page title, for seo purposes too -->
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "Store Front"; ?></title>
 
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />
 
    <!-- admin custom CSS -->
    <link href="<?php echo $home_url . "libs/css/admin.css" ?>" rel="stylesheet" />
    <link href="<?php echo $home_url . "style.css" ?>" rel="stylesheet" />
 
</head>
<body>
    <br><br>
<?php

// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// retrieve records here
// include database and object files
// include classes

include_once 'config/database.php';
include_once 'objects/teaching.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objteaching = new teaching($db);

// set ID property of download to be read
$objteaching->id=$id;

  
// read the details of download to be read
$objteaching->readOne();
// set page header
//$page_title = "Read Teaching";

//include_once "layout_head.php";



// read products button

echo'<div class="row">';
echo'<div class="col-md-3">';
echo'</div>';
echo'<div class="col-md-6 ">';
echo "<div class='right-button-margin'>";
    echo "<a href='teaching.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read STTP/FDP";
    echo "</a>";
echo "</div>";
 echo"<h2>Details</h2> <hr>";
 echo"";
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
        echo "<td><a href='admin/pdf/{$objteaching->certificate}' target='_blank'>certificate</a></td>";
    echo "</tr>";

    // echo "<tr>";
    //     echo "<td>certificate</td>";
    //     echo "<td width='10%'><a href='admin/img/{$objteaching->certificate}' target='_blank'><img src='admin/img/{$objteaching->certificate}' style='width:30%;'></a></td>";
    // echo "</tr>";

    echo "<tr>";
        echo "<td>schedule</td>";
        echo "<td><a href='admin/pdf/{$objteaching->schudule}' target='_blank'>schudule</a></td>";
    echo "</tr>";
        echo "<tr>";
        echo "<td>photo1</td>";
    echo "<td width='10%'><a href='admin/img/{$objteaching->photo1}' target='_blank'><img src='admin/img/{$objteaching->photo1}' style='width:30%;'></a></td>";
    echo "</tr>";
        echo "<tr>";
        echo "<td>photo2</td>";
    echo "<td width='10%'><a href='admin/img/{$objteaching->photo2}' target='_blank'><img src='admin/img/{$objteaching->photo2}' style='width:30%;'></a></td>";
    echo "</tr>";
    
    echo "</table>";

    echo'<div class="col-md-3">';
    echo'<div>';
    echo'<div>';
?>
</body>
