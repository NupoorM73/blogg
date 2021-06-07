<?php

// get ID of the download to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Update Teaching";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/teaching.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$teaching = new teaching($db);
// set ID property of product to be edited
$teaching->id = $id;
// read the details of product to be edited
$teaching->readOne();

include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_teaching.php' class='btn btn-default pull-right'>Read Downloads</a>
    </div>";
  
?>


<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    
    // set teaching property values
   
    $teaching->title = $_POST['title'];
    $teaching->organized_by = $_POST['organized_by'];
    $teaching->level = $_POST['level'];
    $teaching->from_date = $_POST['from_date'];
    $teaching->to_date = $_POST['to_date'];
    $teaching->duration = $_POST['duration'];
    $teaching->certificate = !empty($_FILES["certificate"]["name"])
    ? sha1_file($_FILES['certificate']['tmp_name']) . "-" . basename($_FILES["certificate"]["name"]) : "";

    $teaching->schudule = !empty($_FILES["schudule"]["name"])
    ? sha1_file($_FILES['schudule']['tmp_name']) . "-" . basename($_FILES["schudule"]["name"]) : "";
   
   
    $teaching->photo1 = !empty($_FILES["photo1"]["name"])
    ? sha1_file($_FILES['photo1']['tmp_name']) . "-" . basename($_FILES["photo1"]["name"]) : "";
   
    $teaching->photo2 = !empty($_FILES["photo2"]["name"])
    ? sha1_file($_FILES['photo2']['tmp_name']) . "-" . basename($_FILES["photo2"]["name"]) : "";
  //  $teaching->modification_on = $_POST['modification_on'];
    $teaching->id = $_POST['id'];
  //  $teaching->video_link = $_POST['video_link'];


    // create the download
    if($teaching->update()){
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $teaching->uploadPhoto1();
        echo $teaching->uploadPdf();
        echo $teaching->uploadPhoto3();
        echo $teaching->uploadPhoto4();

       
        echo "<div class='alert alert-success'>Teaching saved successfully</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save teaching</div>";
    }
}
?>

<!-- 'create downloads' html form will be here -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">

     
<table class="table table-bordered table-responsive">
    <!-- // title
    // organized_by
    // level
    // from_date
    
    // to_date
    // duration
    // certificate
    // schedule
    // photo1
    // photo2 -->
    <tr>
        <td><label class="control-label">teaching ID</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='<?php echo $id ?>' type="text" name="id"  readonly /></td>
       </tr>
    <tr>
            <td>Title</td>
            <td><input type='text' name='title' class='form-control'  value='<?php echo $teaching->title; ?>'/></td>
        </tr>
        <tr>
            <td>Organized By</td>
            <td><input type='text' name='organized_by' class='form-control' value='<?php echo $teaching->organized_by; ?>'/></td>
        </tr>
        
        <tr>
            <td>Level</td>
                                <td>
                            

                      
                    <select class='form-control form-select' name='level'  >
                   
                    <option value="International" value='<?php echo $teaching->level; ?>'>International</option>
                    <option value="National" value='<?php echo $teaching->level; ?>'>National</option>
                    <option value="State" value='<?php echo $teaching->level; ?>'>State</option>
                    </select>
                    
                           </td>         
        </tr>
        <tr>
            <td>From Date</td>
            <td><input type='date' name='from_date' class='form-control' value='<?php echo $teaching->from_date; ?>'/></td>
        </tr>
        <tr>
            <td>To Date</td>
            <td><input type='date' name='to_date' class='form-control' value='<?php echo $teaching->to_date; ?>'/></td>
        </tr>
        <tr>
            <td>Duration</td>
            <td><input type='text' name='duration' class='form-control' value='<?php echo $teaching->duration; ?>'/></td>
        </tr>
        <tr>
	          <td>Certificate</td>
	          <td><input type="file" name="certificate" multiple accept="image/*"/>
              <img src="img/<?php echo $teaching->certificate; ?>" width="10%" alt="">
              </td>
          </tr>
          
        <tr>
        <td><label class="control-label">Schedule</label></td>
           <td><input class="input-group" value='<?php echo $teaching->pdf; ?>' type="file" name="schudule" accept=".pdf" />
           <a href='pdf/<?php echo $teaching->schudule?>' target='_blank'><?php echo $teaching->schudule ?></a>
           </td>
       </tr>
          <!-- <tr>
	          <td>Schedule</td>
	          <td><input type="file" name="schedule" multiple/>
              <img src="img/" width="10%" alt="">
              </td>
          </tr> -->
          <tr>
	          <td>Photo1</td>
	          <td><input type="file" name="photo1" multiple accept="image/*"/>
              <img src="img/<?php echo $teaching->photo1; ?>" width="10%" alt="">
              </td>
          </tr>
          <tr>
	          <td>Photo2</td>
	          <td><input type="file" name="photo2" multiple accept="image/*"/>
              <img src="img/<?php echo $teaching->photo2; ?>" width="10%" alt="">
              </td>
          </tr>
      
       <tr>
           <td colspan="2"><button type="submit" name="btnsave" style="background-color: blue;color:white" class="btn btn-default">
           <span class="glyphicon glyphicon-save"></span> &nbsp; Save teaching
           </button>
           </td>
       </tr>
       
       </table>
       
   </form>

<?php
  
// footer
include_once "layout_foot.php";
?>