<?php
// set page headers

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Add Teaching";
 
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

$page_title = "Create Teaching";
include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_teaching.php' class='btn btn-default pull-right'>Read teaching</a>
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
    
  //  $teaching->video_link = $_POST['video_link'];


    // create the download
    if($teaching->create()){
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $teaching->uploadPdf();
        echo $teaching->uploadPdf1();
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

<!-- 'create teaching' html form will be here -->
<form method="post" enctype="multipart/form-data" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     
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
            <td>Title</td>
            <td><input type='text' name='title' class='form-control' /></td>
        </tr>
        <tr>
            <td>Organized By</td>
            <td><input type='text' name='organized_by' class='form-control' /></td>
        </tr>
        
        <tr>
            <td>Level</td>
                                <td>
                            

                      
                    <select class='form-control form-select' name='level'>
                   
                    <option value="International">International</option>
                    <option value="National">National</option>
                    <option value="State">State</option>
                    </select>
                    
                           </td>         
        </tr>
        <tr>
            <td>From Date</td>
            <td><input type='date' name='from_date' class='form-control' /></td>
        </tr>
        <tr>
            <td>To Date</td>
            <td><input type='date' name='to_date' class='form-control' /></td>
        </tr>
        <tr>
            <td>Duration</td>
            <td><input type='text' name='duration' class='form-control' /></td>
        </tr>
        <tr>
	          <td>Certificate</td>
	          <td><input type="file" name="certificate" multiple accept=".pdf"/></td>
          </tr>
          <tr>
	          <td>Schedule</td>
	          <td><input type="file" name="schudule" multiple accept=".pdf"/></td>
          </tr>
          <tr>
	          <td>Photo1</td>
	          <td><input type="file" name="photo1" multiple/></td>
          </tr>
          <tr>
	          <td>Photo2</td>
	          <td><input type="file" name="photo2" multiple/></td>
          </tr>
        
      
       <tr>
           <td colspan="2"><button type="submit" name="btnsave" style="background-color: blue;color:white" class="btn btn-default">
           <span class="glyphicon glyphicon-save"></span> &nbsp; Save Teaching
           </button>
           </td>
       </tr>
       
       </table>
       
   </form>

<?php
  
// footer
include_once "layout_foot.php";
?>