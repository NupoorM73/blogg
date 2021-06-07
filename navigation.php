<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" style="background-color: #126e82;" role="navigation">
    <div class="container-fluid">
 
        <div class="navbar-header">
            <!-- to enable navigation dropdown when viewed in mobile device -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
 
            <!-- Change "Your Site" to your site name -->
            <a style="color: white; font-family: 'Montserrat', sans-serif; font-size: 2.0rem; font-weight: bold; padding: 10px; " class="navbar-brand" href="<?php echo $home_url; ?>">Dr. Yuvraj Parkale</a>
        </div>
 
        <div class="navbar-collapse collapse">
           <!--
            <ul class="nav navbar-nav">
                 link to the "Cart" page, highlight if current page is cart.php 
                <li <?php echo $page_title=="Index" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>">Home</a>
                </li>
            </ul>
        -->
            <?php
            // check if users / customer was logged in // if user was logged in, show "Edit Profile", "Orders" and "Logout" options
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='Admin'){
    ?>
    <ul class="nav navbar-nav navbar-right w3-light-green">
        <li <?php echo $page_title=="Edit Profile" ? "class='active'" : ""; ?>>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                  <?php echo $_SESSION['email']; ?>
                  <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
    <?php
    }
     
    // if user was not logged in, show the "login" and "register" options
else{
    ?>
   <!-- <ul class="nav navbar-nav navbar-right">
        <li <?php echo $page_title=="Login" ? "class='active'" : ""; ?>>
            <a href="<?php echo $home_url; ?>login">
                <span class="glyphicon glyphicon-log-in"></span> Log In
            </a>
        </li>
     
       
    </ul>
-->
    <?php
    }
            ?>
             
        </div><!--/.nav-collapse -->
 
    </div>
</div>
<!-- /navbar -->
