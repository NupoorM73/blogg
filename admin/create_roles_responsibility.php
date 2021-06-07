
<?php
// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Add Roles & Responsibility";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/roles_responsibility.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$rolres = new rolres($db);

$page_title = "Create Roles & Responsibility";
include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_roles_responsibility.php' class='btn btn-default pull-right'>Read Roles & Responsibility</a>
    </div>";
  
?>
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set rolres property values
    $rolres->name_commitee = $_POST['name_commitee'];
    $rolres->role = $_POST['role'];
    $rolres->level = $_POST['level'];
    $rolres->academic_year = $_POST['academic_year'];
    $rolres->name_event = $_POST['name_event'];

    $rolres->letter_appointment = !empty($_FILES["letter_appointment"]["name"]) 
    ? sha1_file($_FILES['letter_appointment']['tmp_name']) . "-" . basename($_FILES["letter_appointment"]["name"]) : "";

    $rolres->date_appointment = $_POST['date_appointment'];
    $rolres->desc_role = $_POST['desc_role'];
    
    $rolres->report_task = !empty($_FILES["report_task"]["name"]) 
    ? sha1_file($_FILES['report_task']['tmp_name']) . "-" . basename($_FILES["report_task"]["name"]) : "";

    $rolres->createdby = $_POST['createdby'];
 
    $rolres->modifiedby = $_POST['modifiedby'];


  


    // create the download
    if($rolres->create()){
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $rolres->uploadPdf();

        echo $rolres->uploadPdf1();

        echo "<div class='alert alert-success'>Roles & Responsibility saved successfully</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save Roles & Responsibility</div>";
    }
}
?>
   <html>
    <head>
        <script>
            //  

                function select(){
                    var d= document.getElementById("dselect");
                    var displaytext=d.options[d.selectedIndex].text;
                    var str="others";
                    document.getElementById("txtvalue").value=displaytext;
                    if(displaytext.localeCompare(str)==0){
                        document.getElementById("txtvalue").value="";
                        document.getElementById("txtvalue").focus();
                    }
                }
               
            </script>
    </head> 
<body>  
<!-- 'create rolres' html form will be here -->
<form method="post" enctype="multipart/form-data" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     
    <table class="table table-bordered table-responsive">    
       <tr>
        <td><label class="control-label">Name of committee</label><b style="color:red">*</b></td>
           <td><input class="form-control" type="text" name="name_commitee" required autofocus placeholder="Enter name commitee" value="" /></td>
       </tr>
       
       <tr>
        <td><label class="control-label">Role</label></td>
           <td><input class="form-control" type="text" name="role" placeholder="Enter role" value="" /></td>
       </tr>

       <tr>
       <td><label class="control-label">Level</label><b style="color:red">*</b></td>
       <td>
            <select id="dselect" class="form-select" aria-label="Default select example" name="level" onchange="select();">
  		        <option class="form-control"  value="Departmental">Departmental</option>
  		        <option class="form-control"  value="college">college</option>
                <option class="form-control"  value="University">University</option>
  		        <option class="form-control"  value="others">others</option>
            </select>
             <br><br>
           <input id="txtvalue" class="form-control" type="text" name="level" required/>

        </td>
       </tr>

       <tr>
        <td><label class="control-label">Academic year</label></td>
           <td><input class="form-control" type="text" name="academic_year" placeholder="Enter Academic year (eg.2019-20)" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Name of Event</label></td>
           <td><input class="form-control" type="text" name="name_event" placeholder="Enter Name of Event" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Letter of Appointment</label></td>
           <td><input class="input-group" type="file" name="letter_appointment" accept=".pdf"/></td>
       </tr>

       <tr>
        <td><label class="control-label">Date of Appointment</label></td>
           <td><input class="form-control" type="date" name="date_appointment" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Descrption of Role</label></td>
           <td><textarea class="form-control" type="text" name="desc_role" value="" placeholder="Enter Descrption Role"></textarea></td>
       </tr>
     
       <tr>
         <td><label class="control-label">Report of Task completed</label></td> 
           <td><input class="input-group" type="file" name="report_task" accept=".pdf"/></td> 
        </tr> 
      
        <tr>
        <td><label class="control-label">Createdby</label></td>
           <td><input class="form-control" type="text" name="createdby" placeholder="Enter createdby" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Modifiedby</label></td>
           <td><input class="form-control" type="text" name="modifiedby" placeholder="Enter modifiedby" value="" /></td>
       </tr>
     
       <tr>
           <td colspan="2"><button type="submit" name="btnsave" style="background-color: blue;color:white" class="btn btn-default">
           <span class="glyphicon glyphicon-save"></span> &nbsp; Save Roles & Responsibility
           </button>
           </td>
       </tr>

       
       </table>
       
   </form>
</body>
</html>
<?php
  
// footer
include_once "layout_foot.php";
?>