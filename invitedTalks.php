<?php
include_once "top.php";

include_once "menu.php";


?>
<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">
<div class="w3-row-padding"><br />
<br /><br />
</div>
  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="images/PhD defence.jpg" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            
          </div>
        </div>
        <div class="w3-container">
        <h2>Dr. Yuvraj Parkale</h2>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Assistant Professor,(15 years)<br /> 
Department of Electronics and Telecommunication Engineering  <br />
S. V. P. M’s College of Engineering, <br />
Malegaon (Bk), Baramati,  </p>
          <b>Area of intreset-</b>Compressed Sensing (CS),Optimization Techniques and Algorithms,  
            Signal Processing  , Embedded Systems and IoT, Machine Learning
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>Mahartshra, India</p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>yuvrajparkale@gmail.com</p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>09860307571</p>
          <hr>

         

    <br />
    <br />      
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h3 class="w3-text-blue w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>
       Invited Talks </h3>
        <!-- <p class="w3-large w3-text-black"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-blue"></i> Resource  Person  for  one-week  AICTE  approved  Faculty  Development 
Program  on  “Statistical  Inference  and  Linear  Algebra”, held at Dr.  BATU, 
Lonere, Raigad during 21st to 25th December 2019.</b></p> -->
<?php
 // core configuration
// include_once "../config/core.php";
 
// // check if logged in as admin
// include_once "login_checker.php";

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// retrieve records here
// include database and object files
// include classes
include_once 'config/database.php';
include_once 'objects/invtalks.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objinvtalks = new invtalks($db);


// set page header
//$page_title = "Read Invited Talks";

//include_once "layout_head.php";


echo "<div class='col-md-12'>"; 

    // query products
    $stmt = $objinvtalks->readAll($from_record_num, $records_per_page);
    $num = $stmt->rowCount();
     //echo $num;
    
    $total_rows=$num;
     // count retrieved users
        $num = $stmt->rowCount();
     
        // to identify page for paging
        $page_url="admin/read_invtalks.php?";
     
        // include invtalks table HTML template
       // include_once "invdetails.php";
    
if($total_rows>0){
  echo"<div class='table table-responsive'>";
   echo "<table class='table table-hover table-bordered'>";
       echo "<tr>";
          
           echo "<th>title</th>";
           echo "<th>organizedby</th>";
           echo "<th>level</th>";
           echo "<th>type</th>";
           // echo "<th>fromdate</th>";
           // echo "<th>todate</th>";
           // echo "<th>Duration</th>";
           // echo "<th>unit</th>";
           // echo "<th>certificate</th>";
           // echo "<th>schedule</th>";
           // echo "<th>photo1</th>";
           // echo "<th>photo2</th>";
       echo "</tr>";

       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

           extract($row);

           echo "<tr>";
           
               //echo "<td>{$talk_id}</td>";
               echo "<td>{$title}</td>";
               echo "<td>{$organizedby}</td>";
               echo "<td>{$level}</td>";
               echo "<td>{$type}</td>";
               // echo "<td>{$fromdate}</td>";
               // echo "<td>{$todate}</td>";
               // echo "<td>{$Duration}</td>";
               // echo "<td>{$unit}</td>";

               // echo "<td><a href='pdf/{$certificate}' target='_blank'>certificat</a></td>";
               // echo "<td><a href='pdf/{$schedule}' target='_blank'>schedule</a></td>";

               // echo "<td width='10%'><a href='img/{$photo1}' target='_blank'><img src='img/{$photo1}' style='width:30%;' ></a></td>";
           
               // echo "<td width='10%'><a href='img/{$photo2}' target='_blank'><img src='img/{$photo2}' style='width:30%;' ></a></td>";

             
               echo "<td>";
           
                   // read downloads button
                   echo "<a href='invdetails.php?id={$talk_id }' class='btn btn-primary left-margin'>";
                       echo "<span class='glyphicon glyphicon-list'></span> Details";
                   echo "</a> &nbsp";
               echo"</td>";




           echo "</tr>";

       }

   echo "</table>";
   echo"</div>";

$page_url="admin/read_invtalks.php?";
   $total_rows = $objinvtalks->countAll();
   // paging buttons
  // include_once 'paging.php';
}

// tell the user there are no products
else{
   echo "<div class='alert alert-danger'>No Invited Talks found.</div>";
}
    
//echo "</div>";

// set page footer
//include_once "layout_foot.php";
?>   
      </div>

      
      <br />
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

