<?php
// get ID of the product to be read
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die('ERROR: missing ID.');

 
// include database and object files
include_once 'config/database.php';
include_once 'config/core.php';
include_once 'objects/blogpost.php';
include_once 'objects/comments.php';
include_once 'objects/replies.php';
include_once 'objects/image.php';
include_once 'login_checker.php';

$ab=0; 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$post = new Post($db);
$comment = new Comment($db);
$reply = new Replies($db);
$img=new Image($db);
 
// set ID property of product to be read
$post->post_id = $post_id;
$comment->post_id = $post_id;
$reply->post_id=$post_id;
$img->post_id=$post_id;


// read the details of product to be read
$post->readOne();
$stmtt=$comment->readOne();
$stmttr=$reply->readRAll();
$stmttt=$img->readone();

$post->post_id = $post_id;
// set page headers
$page_title = "Read One Product";
//include_once "layout_header.php";
include_once 'ft1.php';


$row2 = $stmttt->fetch(PDO::FETCH_ASSOC);

$total_rows1=$comment->countAll();
$total_rows2=$reply->countAll();
$total=$total_rows1 + $total_rows2; 
    // HTML table for displaying a product details-->
    echo "<div class='middle-container'>";
    echo "<div class='contact-me'>";
    echo "<h2>{$post->title}</h2>";
    echo "<h4>{$post->titledes}</h4>";
    echo "<div class='img'>";
  echo '  <div class = "album py-5"> ';
  echo '     <div class="row"> ';
    // echo $img->imageid1 ? "<img src='uploads/image/{$img->imageid1}' style='width:600px;' />" : "No image found.";
    // echo $img->imageid2 ? "<img src='uploads/image/{$img->imageid2}' style='width:600px;' />" : "No image found.";
    // echo $img->imageid3 ? "<img src='uploads/image/{$img->imageid3}' style='width:600px;' />" : "No image found.";
    echo '<div class="mb-4">';
       
          echo "<img src='uploads/image/".$row2['imageid1']." ' alt='Nature' style='width:50%'>";  
          echo "<br>";
          echo "<br>";
            echo " <img src='uploads/image/".$row2['imageid2']." ' alt='Nature' style='width:50%'> ";  
          echo "<br>";
          echo "<br>";
          echo " <img src='uploads/image/".$row2['imageid3']." ' alt='Nature' style='width:50%'> ";  
          echo "<br>";
        
          echo " </div>";
          
          echo " </div>"; 
    echo " </div>";
    echo "<div class='b'>"; 
    echo "<h5>By {$post->email} on {$post->publicationdate}</h5>";
    echo "<p style='margin-left:200px ; margin-right:200px;'> {$post->description} </p>";
    echo "<a href='{$post->link}'> {$post->link} </a>";
   // echo $post->ppt ? "<iframe src='uploads/ppt/{$post->ppt}' style='width:600px;' /></iframe>" : "PPT not provided by the author.";
    echo "<br>"; 
    echo "<br>"; 
    echo "<a class='' href='uploads/pdf/{$post->pdf}'><i class='fas fa-file-pdf fa-3x' aria-hidden='true'></i>&nbsp;PDF for reference </a>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<a target='_blank' class='' href='uploads/ppt/{$post->ppt}' ><i class='fas fa-file-powerpoint fa-3x'></i>&nbsp; PPT for reference </a>";
    echo "<br>"; 
    echo "</div>";
    echo "</div>";
    echo "</div>";
                  
 if(isset($_POST['submit_comment'])){
         $comment->email=$_POST['email'];
         $comment->comment_body=$_POST['comment_body'];
         $comment->post_id=$post->post_id;
         
        if($comment->create())
        {
          echo "You commented on this post";
        }
        else
        {
           echo "Error occurs";
        }
    }
    if(isset($_POST['replysubmit']))
    {
        $reply->email=$_POST['email'];
        $reply->body=$_POST['body'];
        $reply->comment_id=$ab;
        $reply->post_id=$post->post_id;
         
        if($reply->createR())
        {
           echo 'You replied on this comment';
        }
        else{
            echo 'Was not able to create the comment';
        }
    }
echo '<div class=" container  p-3 my-3 border"';
    echo '<div class="col-md-6 col-md-offset-3 comments-section">';
    // comment form
echo '<form class="clearfix" method="post" id="comment_form">';
echo '<h4>Write your Name or Email:</h4>';
echo "<input type='text' name='email' placeholder='Your Name' class='form-control' required/>";
echo '<h4>Post a comment:</h4>';
echo '<textarea name="comment_body" id="comment_text" class="form-control" cols="30" rows="3" required></textarea>';
echo " <button class='btn btn-primary btn-sm pull-right' name='submit_comment'>Submit comment</button>";
echo ' </form>';
    // Display total number of comments on this post  -->
echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div class="comments-area">';
echo '<h6><b id="comments_count"> '.$total.' Comment(s)</b></h6>';

if($total_rows1>0)
{
    ?>
       <?php
        while ($row = $stmtt->fetch(PDO::FETCH_ASSOC)){
       echo '<div class="comment-list">';
       echo ' <div class="single-comment justify-content-between d-flex">';
         echo ' <div class="user justify-content-between d-flex">';
         echo '   <div class="thumb">';
         echo '     <i class="fa fa-user" style="font-size:30px; width:30px;"></i>';
          echo '  </div>';
         echo '   <div class="desc">';
                echo "<h4>" .$row['email']."</h4>";
                echo    " <small class='text-muted date'>" . $row['created_at']. "</small>";
                echo "<p class='comment'>". $row['comment_body']. "</p>";
                echo '</div>';
               echo ' </div>';
               echo '<div class="dropdown">';
            echo '<button class="btn-secondary replybox dropdown-toggle" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">View reply</button>';
            echo " <ul class='dropdown-menu align-items-center' aria-labelledby='dropdownMenuButton' >";
    //         echo '</div>';
    //    echo ' </div>';
    //  echo ' </div>';
                // echo " <div class='d-flex justify-content-between align-items-center'>";
                //   echo " <div class='dropdown'>";
                //   echo "  <button class='dropdown-toggle dt' data-toggle='dropdown'>View Reply </button>";
                //   echo " <ul class='dropdown-menu align-items-center' >";
                  while($rowr = $stmttr->fetch(PDO::FETCH_ASSOC)){
                  
                      echo "<h4> "  .$rowr['email']. " </h4>";
                      echo "<p class='comment'> "  .$rowr['body'] . " </p>";
                      echo'<hr style="height:2px;width:4%;color:gray;background-color:gray; padding:0">';
                  }
                   echo      "  </ul>";
                   echo '</div>';
       echo ' </div>';
     echo ' </div>';               
                  echo " <div class='d-flex justify-content-between align-items-center replybox'>";
                  echo " <div class='dropdown'>";
                  echo "  <a class='dropdown-toggle dt replybox' data-toggle='dropdown'>Reply </a>";
                  echo " <ul class='dropdown-menu'  >";
                  echo "  <form method='post'>";
                  echo "   <div class=''>";
                  $ab=$row['comment_id'];
                  echo"<h6>Name</h6> ";
                  echo "<input type='text' name='email' placeholder='Your Name' class='form-control' required/>";     
                  echo "    <li><textarea style='margin-left: 20px;' class='retext' type='text' name='body' required></textarea></li>";
                  //echo "   <input type='hidden' value=' ".." '>";
                  echo "   </div>";
                  echo "    <br>";
            ?>
                  <button class="btn btn-primary" name="replysubmit" type="submit">Submit</button>
               <?php
                echo "   </form>";
                   echo      "  </ul>";
                        echo "     </div> ";
                        // echo    " <small class='text-muted'>" . $row['created_at']. "</small>";
                  echo" </div>";
                 echo'<hr style="height:2px;width:4%;color:gray;background-color:gray; padding:0">';  
        }  
        echo "</div>";
}
    //comments wrapper -->
     echo" </div>";
    echo" </div>";
    echo" </div>";
    echo" </div>";
// set footer

?>