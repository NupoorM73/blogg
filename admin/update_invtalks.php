<?php

// get ID of the download to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Update Invited Talks";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/invtalks.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$invtalks = new invtalks($db);
// set ID property of product to be edited
$invtalks->talk_id  = $id;
 
// read the details of product to be edited
$invtalks->readOne();

include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_invtalks.php' class='btn btn-default pull-right'>Read Invited Talks</a>
    </div>";
  
?>


<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set invtalks property values
    $invtalks->title = $_POST['title'];
    $invtalks->organizedby = $_POST['organizedby'];
    $invtalks->level = $_POST['level'];
    $invtalks->type = $_POST['type'];
    $invtalks->fromdate = $_POST['fromdate'];
    $invtalks->todate = $_POST['todate'];
    $invtalks->Duration = $_POST['Duration'];
    $invtalks->unit = $_POST['unit'];
   
    $invtalks->certificate = !empty($_FILES["certificate"]["name"])
    ? sha1_file($_FILES['certificate']['tmp_name']) . "-" . basename($_FILES["certificate"]["name"]) : "";

   
    $invtalks->schedule = !empty($_FILES["schedule"]["name"])
    ? sha1_file($_FILES['schedule']['tmp_name']) . "-" . basename($_FILES["schedule"]["name"]) : "";


    $invtalks->photo1 = !empty($_FILES["photo1"]["name"])
    ? sha1_file($_FILES['photo1']['tmp_name']) . "-" . basename($_FILES["photo1"]["name"]) : "";
    
    $invtalks->photo2 = !empty($_FILES["photo2"]["name"])
    ? sha1_file($_FILES['photo2']['tmp_name']) . "-" . basename($_FILES["photo2"]["name"]) : "";
   

    $invtalks->talk_id  = $_POST['id'];



    // create the update
    if($invtalks->update()){
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $invtalks->uploadPdf();

        echo $invtalks->uploadPdf1();

        echo $invtalks->uploadPhoto();

        echo $invtalks->uploadPhoto1();

        echo "<div class='alert alert-success'>Invited Talks saved successfully</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save Invited Talks</div>";
    }
}
?>


<!-- 'create invtalks' html form will be here -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">

     
    <table class="table table-bordered table-responsive">
    
    <tr>
        <td><label class="control-label">id</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='<?php echo $id?>' type="text" name="id"  readonly /></td>
    </tr>
    
    <tr>
        <td><label class="control-label">title</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='<?php echo $invtalks->title; ?>' type="text" name="title" required autofocus placeholder="Enter title" value="" /></td>
    </tr>
       
    <tr>
        <td><label class="control-label">organizedby</label></td>
           <td><input class="form-control" value='<?php echo $invtalks->organizedby; ?>' type="text" name="organizedby" placeholder="Enter organizedby" value="" /></td>
    </tr>
    
    <tr>
       <td><label class="control-label">level</label><b style="color:red">*</b></td>
       <td>
            <select class="form-select" aria-label="Default select example" name="level">
  		        <option class="form-control"  value="International">International</option>
  		        <option class="form-control"  value="National">National</option>
                <option class="form-control"  value="State">State</option>
  		        <option class="form-control"  value="Local">Local</option>
            </select>
        </td>
    </tr>

    <tr>
       <td><label class="control-label">type</label><b style="color:red">*</b></td>
       <td>
            <select class="form-select" aria-label="Default select example" name="type">
  		        <option class="form-control"  value="FDP">FDP</option>
  		        <option class="form-control"  value="Workshop Student">Workshop Student</option>
                <option class="form-control"  value="Expert Lecture">Expert Lecture</option>
            </select>
        </td>
    </tr>

    <tr>
        <td><label class="control-label">fromdate</label></td>
           <td><input class="form-control" type="date" name="fromdate" value="" /></td>
    </tr>

    <tr>
        <td><label class="control-label">todate</label></td>
           <td><input class="form-control" type="date" name="todate" value="" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Duration</label></td>
           <td><input class="form-control" value='<?php echo $invtalks->Duration; ?>' type="text" name="Duration" placeholder="Enter Duration" value="" /></td>
    </tr>   

    <tr>
       <td><label class="control-label">unit</label><b style="color:red">*</b></td>
       <td>
            <select class="form-select" aria-label="Default select example" name="unit">
  		        <option class="form-control"  value="Day">Day</option>
                <option class="form-control"  value="Week">Week</option>
            </select>
        </td>
    </tr>

    <tr>
        <td><label class="control-label">certificate</label></td>
           <td><input class="input-group" value='<?php echo $invtalks->certificate; ?>' type="file" name="certificate" accept=".pdf" />
           <a href='pdf/<?php echo $invtalks->certificate ?>' target='_blank'><?php echo $invtalks->certificate ?></a>
           </td>
    </tr>

    <tr>
        <td><label class="control-label">schedule</label></td>
           <td><input class="input-group" value='<?php echo $invtalks->schedule; ?>' type="file" name="schedule" accept=".pdf" />
           <a href='pdf/<?php echo $invtalks->schedule ?>' target='_blank'><?php echo $invtalks->schedule ?></a>
        </td>
    </tr>

    <tr>
        <td><label class="control-label">photo1</label></td>
        <td><input class="input-group" type="file" name="photo1" accept="image/*" />
            <img src="img/<?php echo $invtalks->photo1; ?>" width="10%" alt=""></td>
    </tr>

    <tr>
        <td><label class="control-label">photo2</label></td>
        <td><input class="input-group" type="file" name="photo2" accept="image/*" />
            <img src="img/<?php echo $invtalks->photo2; ?>" width="10%" alt=""></td> 
    </tr>

      
     <tr>
        <td colspan="2"><button type="submit" name="btnsave" style="background-color: blue;color:white" class="btn btn-default">
            <span class="glyphicon glyphicon-save"></span> &nbsp; Save Invited Talks
            </button>
        </td>
    </tr>
       
       </table>
       
   </form>

<?php
  
// footer
include_once "layout_foot.php";
?>


