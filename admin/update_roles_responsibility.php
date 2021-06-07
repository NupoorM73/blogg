<?php

// get ID of the download to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Update Roles & Responsibility";
 
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
// set ID property of product to be edited
$rolres->role_id  = $id;
 
// read the details of product to be edited
$rolres->readOne();

include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_roles_responsibility.php' class='btn btn-default pull-right'>Read Roles & Responsibility</a>
    </div>";
  
?>


<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
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

    $rolres->role_id  = $_POST['id'];



    // create the update
    if($rolres->update()){
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

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">

     
    <table class="table table-bordered table-responsive">
    
    <tr>
        <td><label class="control-label">Role id</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='<?php echo $id?>' type="text" name="id"  readonly /></td>
    </tr>
    
    <tr>
        <td><label class="control-label">Name of committee</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='<?php echo $rolres->name_commitee; ?>' type="text" name="name_commitee" required autofocus placeholder="Enter name_commitee" value="" /></td>
    </tr>
       
    <tr>
        <td><label class="control-label">Role</label></td>
           <td><input class="form-control" value='<?php echo $rolres->role; ?>' type="text" name="role" placeholder="Enter role" value="" /></td>
    </tr>
    
    <tr>
       <td><label class="control-label">Level </label><b style="color:red">*</b></td>
       <td>
            <select id="dselect" class="form-select" aria-label="Default select example" name="level" onchange="select();">
  		        <option class="form-control"  value="Departmental">Departmental</option>
  		        <option class="form-control"  value="college">college</option>
                <option class="form-control"  value="University">University</option>
  		        <option class="form-control"  value="others">others</option>
            </select>

           <input id="txtvalue" class="form-control" type="text" name="level" value='<?php echo $rolres->level; ?>' required/>
                
        </td>
    </tr>


    <tr>
        <td><label class="control-label">Academic year</label></td>
           <td><input class="form-control" value='<?php echo $rolres->academic_year; ?>' type="text" name="academic_year" placeholder="Enter academic_year" value="" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Name of Event</label></td>
           <td><input class="form-control" value='<?php echo $rolres->name_event; ?>' type="text" name="name_event" placeholder="Enter name_event" value="" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Letter of Appointment</label></td>
           <td><input class="input-group" value='<?php echo $rolres->letter_appointment; ?>' type="file" name="letter_appointment" accept=".pdf" />
           <a href='pdf/<?php echo $rolres->letter_appointment ?>' target='_blank'><?php echo $rolres->letter_appointment ?></a>
           </td>
    </tr>

    <tr>
        <td><label class="control-label">Date of Appointment</label></td>
        <td><input type='date' name='date_appointment' class='form-control' value='<?php echo $rolres->date_appointment; ?>'/></td>
          <!-- <td><input class="form-control" type="date" name="date_appointment" value="" /></td> -->
    </tr>



    <tr>
        <td><label class="control-label">Descrption of Role</label></td>
           <td><input class="form-control" value='<?php echo $rolres->desc_role; ?>' type="text" name="desc_role" placeholder="Enter desc_role" value="" /></td>
    </tr>   



    <tr>
        <td><label class="control-label">Report of Task completed</label></td>
           <td><input class="input-group" value='<?php echo $rolres->report_task; ?>' type="file" name="report_task" accept=".pdf" />
           <a href='pdf/<?php echo $rolres->report_task ?>' target='_blank'><?php echo $rolres->report_task ?></a>
        </td>
    </tr>

    <tr>
        <td><label class="control-label">Createdby</label></td>
           <td><input class="form-control" value='<?php echo $rolres->createdby; ?>' type="text" name="createdby" placeholder="Enter createdby" value="" /></td>
    </tr>   

    <tr>
        <td><label class="control-label">Modifiedby</label></td>
           <td><input class="form-control" value='<?php echo $rolres->modifiedby; ?>' type="text" name="modifiedby" placeholder="Enter modifiedby" value="" /></td>
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


