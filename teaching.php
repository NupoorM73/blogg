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
    <div class="w3-half">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h3 class="w3-text-blue w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>
       Work Experience </h3>
        <p class="w3-large w3-text-blue"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-blue">
           </i>Subjects Taught</b></p>
          

         
<?php

$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// retrieve records here
// include database and object files
// include classes
include_once 'config/database.php';
include_once 'subject1.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

 
$objsubject = new subject($db);
 

    // query products
    $stmt = $objsubject->readAll($from_record_num, $records_per_page);
    //$stmt = $objsubject->readAll1($from_record_num, $records_per_page);
   
    $num = $stmt->rowCount();
    
     //echo $num;
    
    $total_rows=$num;
     // count retrieved users
        $num = $stmt->rowCount();
        
     
        // to identify page for paging
        $page_url="admin/read_subject.php?";
     
echo'<div class="row">';

echo'<div class="col-md-6">';
if($total_rows>0){
 
                          
                                echo '<h2 class="bg-warning">UG</h2>';
                                
                              

                            //echo "</tr>";
                    
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                                extract($row);
                    
                               // echo "<tr>";
                               echo "<ul>";
                               
                                     echo"<li>{$subjectname}</li>";
                                  
                                echo "</ul>";
                    
        }
 
    //echo "</table>";
    
    $page_url="admin/read_subject.php?";
    $total_rows = $objsubject->countAll();
    // paging buttons
   // include_once 'admin/paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No Subject found.</div>";
}
echo "</div>";

    //$stmt = $objsubject->readAll($from_record_num, $records_per_page);
    $stmt = $objsubject->readAll1($from_record_num, $records_per_page);
   
    $num = $stmt->rowCount();
    
     //echo $num;
    
    $total_rows=$num;
     // count retrieved users
        $num = $stmt->rowCount();
        
     
        // to identify page for paging
        $page_url="admin/read_subject.php?";

        echo'<div class="col-md-6">';
if($total_rows>0){
 
   
            //echo "<th>ID</th>";
//echo "<th>PG</th>";
echo '<h2 class="bg-warning">PG</h2>';
           
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<ul>";
            
                echo "<li>{$subjectname}</li>";
               
            echo "</ul>";
 
        }
 
    
 $page_url="admin/read_subject.php?";
    $total_rows = $objsubject->countAll();
    
   // echo" $total_rows";
    // paging buttons
   // include_once 'admin/paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No Subject found.</div>";
} 
echo'</div>';
echo'</div>';
?>





</div>
          
    </div>
<!-- Enf of Left Column -->
    <!-- Right  Column -->
    <div class="w3-half">


      <div class="w3-container w3-card ">
        <h2 class="w3-text-blue w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>
        STTP / FDP Attended</h2>
        <div style="overflow-x:auto;">
              
                  
                

              <?php

     
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
include_once 'objects/teaching.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objteaching = new teaching($db);

 

    // query products
    $stmt = $objteaching->readAll($from_record_num, $records_per_page);
    $num = $stmt->rowCount();
     //echo $num;
    
    $total_rows=$num;
     // count retrieved users
        $num = $stmt->rowCount();
     
        // to identify page for paging
        $page_url="admin/read_teaching.php?";
     
        // include downloads table HTML template
       // include_once "admin/read_teaching_template.php";
    
    
//echo "</div>";

if($total_rows>0){
 
  echo"<div class='table table-responsive'>";
  
    echo "<table class='table table-hover table-bordered'>";
        echo "<tr class='bg-success'>";
           // echo "<th>ID</th>";
            echo "<th>Title</th>";
            echo "<th>Organized By</th>";
            echo "<th>Level</th>";
            //echo "<th>From date</th>";
            // echo "<th>To date</th>";
            // echo "<th>Duration</th>";
            //  echo "<th>certificate</th>";
            //  echo "<th>schudule</th>";
            //  echo "<th>photo1</th>";
            //   echo "<th>photo2</th>";
              

        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
            
              //  echo "<td>{$id}</td>";
                echo "<td>{$title}</td>";
                echo "<td>{$organized_by}</td>";
                echo "<td>{$level}</td>";
              //   echo "<td>{$from_date}</td>";
              //   echo "<td>{$to_date}</td>";
              //   echo "<td>{$duration}</td>";
              //   echo "<td width='10%'><a href='admin/img/{$certificate}' target='_blank'><img src='admin/img/{$certificate}' style='width:30%;' ></a></td>";
              //  // echo "<td><a href='pdf/{$pdf}' target='_blank'>Download</a></td>";
              //   echo "<td><a href='admin/pdf/{$schudule}' target='_blank'>schudule</a></td>";
              //   // echo "<td width='10%'><a href='img/{$schudule}' target='_blank'><img src='img/{$schudule}' style='width:30%;' ></a></td>";
              //   echo "<td width='10%'><a href='admin/img/{$photo1}' target='_blank'><img src='admin/img/{$photo1}' style='width:30%;' ></a></td>";
              //   echo "<td width='10%'><a href='admin/img/{$photo2}' target='_blank'><img src='admin/img/{$photo2}' style='width:30%;' ></a></td>";
              //   // read downloads button
                 echo "<td>";
                echo "<a href='details_teaching.php?id={$id}' class='btn btn-primary left-margin'>";
                    echo "<span class='glyphicon glyphicon-list'></span> Details ";
                echo "</a> &nbsp";
                echo "</td>";
 
                    // read downloads button
                   
            echo "</tr>";
 
        }
 
    echo "</table>";
    echo"</div>";
 $page_url="admin/read_downloads.php?";
    $total_rows = $objteaching->countAll();
    
    // paging buttons
   // include_once 'admin/paging_teacher.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No teaching found.</div>";
}
?>



         </div>
        
      </div>
      <br />
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>
<?php
include_once "bottom.php";

?>