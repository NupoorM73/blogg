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
include_once '../objects/invtalks.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objinvtalks = new invtalks($db);


// set page header
$page_title = "Read Invited Talks";

include_once "layout_head.php";


echo "<div class='col-md-12'>"; 

    // query products
    $stmt = $objinvtalks->readAll($from_record_num, $records_per_page);
    $num = $stmt->rowCount();
     //echo $num;
    
    $total_rows=$num;
     // count retrieved users
        $num = $stmt->rowCount();
     
        // to identify page for paging
        $page_url="read_invtalks.php?";
     
        // include invtalks table HTML template
        include_once "read_invtalks_template.php";
    
    
echo "</div>";

// set page footer
include_once "layout_foot.php";
?>