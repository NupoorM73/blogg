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
       UNIVERSITY LEVEL, COLLEGE LEVEL AND DEPARTMENT LEVEL 
RESPONSIBILITIE </h3>

<?php
// core configuration
//include_once "../config/core.php";
 
// check if logged in as admin
//include_once "login_checker.php";

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
include_once 'objects/roles_responsibility.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objrolres = new rolres($db);


// set page header
//$page_title = "Details Roles & Responsibility";

//include_once "layout_head.php";


echo "<div class='col-md-12'>"; 

    // query products
    $stmt = $objrolres->readAll($from_record_num, $records_per_page);
    $num = $stmt->rowCount();
     //echo $num;
    
    $total_rows=$num;
     // count retrieved users
        $num = $stmt->rowCount();
     
        // to identify page for paging
        $page_url="admin/read_roles_responsibility.php?";
     
        // include invtalks table HTML template
        //include_once "admin/read_roles_responsibility_template.php";
    
        if($total_rows>0){
          echo"<div class='table table-responsive'>";
           echo "<table class='table table-hover table-bordered'>";
               echo "<tr class='bg-success'>";
                  // echo "<th>Role id</th>";
                  // echo "<th>Name of committee</th>";
                   echo "<th>Role</th>";
                   echo "<th>Level</th>";
                   echo "<th>Academic year</th>";
                  // echo "<th>Name of Event</th>";
                   echo "<th>Letter of Appointment</th>";
                   echo "<th>Date of Appointment</th>";
                  //  echo "<th>Descrption of Role</th>";
                  //  echo "<th>Report of Task completed</th>";
                  //  echo "<th>Createdby</th>";
                  // echo "<th>Modifiedby</th>";
               echo "</tr>";
        
               while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                   extract($row);
        
                   echo "<tr>";
                   
                      // echo "<td>{$role_id}</td>";
                      //  echo "<td>{$name_commitee}</td>";
                       echo "<td>{$role}</td>";
                       echo "<td>{$level}</td>";
                       echo "<td>{$academic_year}</td>";
                      //  echo "<td>{$name_event}</td>";
                      echo "<td><a href='admin/pdf/{$letter_appointment}' target='_blank'>Download</a></td>";
                       //echo "<td><a href='pdf/{$letter_appointment}' target='_blank'>Download</a></td>";
       
                       echo "<td>{$date_appointment}</td>";
                      //  echo "<td>{$desc_role}</td>";
                      //  echo "<td><a href='pdf/{$report_task}' target='_blank'>Download</a></td>";
       
                      //  echo "<td>{$createdby}</td>";
                      //  echo "<td>{$modifiedby}</td>";
       
                     
                       echo "<td>";
                   
                           // read downloads button
                           echo "<a href='rolesDetails.php?id={$role_id}' class='btn btn-primary left-margin'>";
                               echo "<span class='glyphicon glyphicon-list'></span> Details";
                           echo "</a> &nbsp";
                       echo"</td>";
       
                      //  echo"<td>";
                      //      // edit downloads button
                      //      echo "<a href='update_roles_responsibility.php?id={$role_id}' class='btn btn-info left-margin'>";
                      //          echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                      //      echo "</a> &nbsp";
                      //  echo"</td>";
       
                      //  echo"<td>";
                           // delete downloads button
                      //      echo "<a href='delete_roles_responsibility.php?id={$role_id}' class='btn btn-danger delete-object'>";
                      //          echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                      //      echo "</a> &nbsp";
                      //  echo"</td>";
       
       
        
                   echo "</tr>";
        
               }
        
           echo "</table>";
           echo"</div>";
       
        $page_url="read_roles_responsibility.php?";
           $total_rows = $objrolres->countAll();
           // paging buttons
          // include_once 'paging.php';
       }
        
       // tell the user there are no products
       else{
           echo "<div class='alert alert-danger'>No Roles & Responsibility found.</div>";
       }
       
echo "</div>";

// set page footer
//include_once "layout_foot.php";
?>
        
       
           
        <hr />
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