<?php
include_once "top.php";
include_once "menu.php";



// include database and object files
include_once 'config/database.php';
include_once 'objects/blogpost.php';
include_once 'objects/comments.php';
include_once 'objects/user.php';
include_once 'objects/replies.php';
include_once 'objects/image.php';

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 3;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$comment = new Comment($db);
$user = new User($db);
$reply = new Replies($db);
$post = new Post($db);
$img = new Image($db);



//query posts
$stmt = $post->readAll($from_record_num,$records_per_page);
// specify the page where paging is used
$stmttr=$reply->readRAll();
$rowr = $stmttr->fetch(PDO::FETCH_ASSOC);
// count total rows - used for pagination

$stmttt=$img->readAll();


$total_rows1=$comment->countAll();
$total_rows2=$reply->countAll();
$total=$total_rows1 + $total_rows2; 
$total_rows=$post->countAll();


?>
<!DOCTYPE html>
<html>
  <head>
  <title>Dr. Yuvraj Parkale- Blog</title>
  </head>


<body class="w3-light-grey">
<!-- Navbar -->

    <!-- <div class="w3-top">
        <div style="background-color:#126e82;" class="w3-bar w3-card w3-left-align w3-medium">
            <a style="background-color:#126e82; font-weight: bold; color:white; text-decoration: none;" href="#" class="w3-bar-item w3-button w3-padding-large w3-large">Dr. Yuvraj Parkale</a> <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large  w3-padding-large w3-hover-white w3-large w3-red"
                    href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu">
                    <i class="fa fa-bars"></i></a><a href="#" class="w3-bar-item w3-button w3-padding-large ">
                    </a>
                    <a style="font-family: 'Montserrat', sans-serif; font-size: 1.2rem; color:white;  font-weight: bold; padding: 10px; text-decoration: none;" href="index.php" class="w3-bar-item w3-button w3-padding-medium">Home</a>
                    <a style="font-family: 'Montserrat', sans-serif; font-size: 1.2rem; color:white;  font-weight: bold; padding: 10px; text-decoration: none;" href="portfolio.php" class="w3-bar-item w3-button w3-hide-small w3-padding-medium">About</a> 
                    <a style="font-family: 'Montserrat', sans-serif; font-size: 1.2rem; color:white;  font-weight: bold; padding: 10px; text-decoration: none;" href="blog.php" class="w3-bar-item w3-button w3-hide-small w3-padding-medium">Blog</a> 
                    <a style="font-family: 'Montserrat', sans-serif; font-size: 1.2rem; color:white;  font-weight: bold; padding: 10px; text-decoration: none;" href="research.php" class="w3-bar-item w3-button w3-hide-small w3-padding-medium">Research</a>
                    <a style="font-family: 'Montserrat', sans-serif; font-size: 1.2rem; color:white;  font-weight: bold; padding: 10px; text-decoration: none;" href="teaching.php" class="w3-bar-item w3-button w3-hide-small w3-padding-medium">Teaching</a>
                    <a style="font-family: 'Montserrat', sans-serif; font-size: 1.2rem; color:white;  font-weight: bold; padding: 10px; text-decoration: none;" href="invitedTalks.php" class="w3-bar-item w3-button w3-hide-small w3-padding-medium">Invited Talks</a> 
                    <a style="font-family: 'Montserrat', sans-serif; font-size: 1.2rem; color:white;  font-weight: bold; padding: 10px; text-decoration: none;" href="roles.php" class="w3-bar-item w3-button w3-hide-small w3-padding-medium">Roles and Responsibility</a> 
                    <a style="font-family: 'Montserrat', sans-serif; font-size: 1.2rem; color:white;  font-weight: bold; padding: 10px; text-decoration: none;" href="downloads.php" class="w3-bar-item w3-button w3-hide-small w3-padding-medium">Downloads</a> 
                    <a style="font-family: 'Montserrat', sans-serif; font-size: 1.2rem; color:white;  font-weight: bold; padding: 10px; text-decoration: none;" href="contact.php" class="w3-bar-item w3-button w3-hide-small w3-padding-medium">Contact Us</a>
                          
        </div>
         Navbar on small screens 
       <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
            <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a> <a href="#"
                class="w3-bar-item w3-button w3-padding-large">Link 2</a> <a href="#" class="w3-bar-item w3-button w3-padding-large">
                    Link 3</a> <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
        </div>
    </div> -->


    
<!-- w3-content defines a container for fixed size centered content, 
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1400px">



<!-- Header -->
<header class="w3-container w3-center w3-padding-32"> 
  <h1  style="margin-top:50px;  font-weight: bold;"><b>MY BLOG</b></h1>
  <p>Welcome to the blog of <span class="w3-tag">Dr.Yuvraj Parkale</span></p>
</header>

<!-- Grid -->
<div class="w3-row">
  <?php
  if($total_rows>0)
  {
  ?>
  <!-- Blog entries -->
  <div class="w3-col l8 s12">
    <!-- Blog entry -->
    <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
    <div style="height: 650px; width: 700px; border-radius: 30px;" class="w3-card-4 w3-margin w3-white">
    <?php
    while($row2 = $stmttt->fetch(PDO::FETCH_ASSOC)){
    ?>
        <img src="uploads/image/<?php echo $row2['imageid1'];?>" alt="Nature" style="height: 400px; width: 700px; padding: 30px; background-color: #044459;">
      <?php
  break;  
  }
      ?>
      <div class="w3-container">
        <h3 style="text-align: center; font-family: 'Montserrat', sans-serif; font-size: 2.0rem;  font-weight: bold; color: #424a4d;"><b><?php echo $row['title'];?> </b></h3>
        <br>
        <h5 style= " font-family: 'Montserrat', sans-serif; font-weight: bold; color: #424a4d;"><?php echo $row['titledes'];?><span style="float: right;" class="w3-opacity"><?php echo $row['publicationdate'];?></span></h5>
      </div>
      <br>
      <div class="w3-container">
        <p  style= " font-family: 'Montserrat', sans-serif; font-weight: bold; color: #424a4d;"><?php echo $row['description'];?></p>
        <div class="w3-row">
          <br>
          <div class="w3-col m8 s12">
            <p><button style="background-color: #07303d; color: white; border-radius: 30px;" class="w3-button w3-padding-large"><a style="text-decoration: none;font-family: 'Montserrat', sans-serif; font-weight: bold; color: white;" href="read_one.php?post_id=<?php echo $row['post_id'];?>">READ MORE »</a></button></p>
          </div>
          <!-- <div class="w3-col m4 w3-hide-small">
            <p><span class="w3-padding-large w3-right"><b>  </b> <span class="w3-tag"></span></span></p>
          </div> -->
        </div>
      </div>
    </div>
    <hr>
  
    <!-- Blog entry -->
    <?php
        }
        ?>
  <?php
   // to identify page for paging
   $page_url="blog.php?";
  include_once "paging1.php";
  ?>
  <!-- END BLOG ENTRIES -->
  </div>
  
  <?php
  }
  ?>
  

<!-- Introduction menu -->
<div class="w3-col l4">
  
  
  <!-- Posts -->
  <div class="w3-card w3-margin">
    <div class="w3-container w3-padding" style="border-top-left-radius:18px; border-top-right-radius:18px; color: white;  background:  #044459; background-position: left top;
  background-repeat: repeat;   padding: 10px;   width: 100%;" >
      <h4>Popular Posts</h4>
    </div>
    <ul class="w3-ul w3-hoverable w3-white">
      <li class="w3-padding-16">
        <img src="images/workshop.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large">Lorem</span><br>
        <span>Sed mattis nunc</span>
      </li>
      <li class="w3-padding-16">
        <img src="images/gondol.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large">Ipsum</span><br>
        <span>Praes tinci sed</span>
      </li> 
      <li class="w3-padding-16">
        <img src="images/skies.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large">Dorum</span><br>
        <span>Ultricies congue</span>
      </li>   
      <li class="w3-padding-16 w3-hide-medium w3-hide-small">
        <img src="images/rock.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large">Mingsum</span><br>
        <span>Lorem ipsum dipsum</span>
      </li>  
    </ul>
  </div>
  <hr> 
 
  <!-- Labels / tags -->
  <div class="w3-card w3-margin">
    <div class="w3-container w3-padding" style="border-top-left-radius:18px; border-top-right-radius:18px; font-family: 'Montserrat', sans-serif; font-size: 2.0rem; font-weight: bold; color: white;  background:  #044459; background-position: left top;
  background-repeat: repeat;   padding: 20px;   width: 100%;">
      <h4>Tags</h4>
    </div>
    <div class="w3-container w3-white">
      <br>
    <p><span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">London</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">DIY</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Family</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Shopping</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Games</span>
    </p>
    </div>
  </div>
  
<!-- END Introduction Menu -->
</div>

<!-- END GRID -->
</div><br>

<!-- END w3-content -->
</div>

<!-- Footer -->

<!-- Footer -->
<footer style="background-color: #132c33;" class="w3-container w3-padding-64 w3-center">  
  <div class="w3-xlarge w3-padding-32">
    <i style="color: white; padding: 7px; "  class="fa fa-facebook-official"></i>
    <i style="color: white; padding: 7px;" class="fa fa-instagram"></i>
    <i style="color: white; padding: 7px;" class="fa fa-snapchat"></i>
    <i style="color: white; padding: 7px;" class="fa fa-pinterest-p"></i>
    <i style="color: white; padding: 7px;" class="fa fa-twitter"></i>
    <i style="color: white; padding: 7px;" class="fa fa-linkedin"></i>
 </div>
 <p style="color: white; padding: 7px;" >Powered by <a  style="text-decoration: none;"  href="https://md4ksanalytics.com" target="_blank">MD4KS Analytics Pvt. Ltd</a></p>
</footer>
    <script>
        // slider
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }

        // Used to toggle the menu on small screens when clicking on the menu button
        function myFunction() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
    </script>
</body>
</html>


</body>
</html>
