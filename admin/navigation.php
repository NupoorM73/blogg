<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
 
        <div class="navbar-header navbar-right">
            <!-- to enable navigation dropdown when viewed in mobile device -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
 
            <!-- Change "Site Admin" to your site name -->
          <!--  <a class="navbar-brand" href=" echo $home_url; ?>admin/index.php">
            <img  src='../images/logo.jpg' width='20%' > 
            Admin</a>-->
        </div>
 
        <div class="navbar-collapse collapse">
           
            <!-- options in the upper right corner of the page -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        &nbsp;&nbsp;<?php echo $_SESSION['email']; ?>
                        &nbsp;&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <!-- log out user -->
                        <li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
 
            <ul class="nav navbar-nav navbar-right ">
 
                    
                    <!-- highlight for order related pages -->
                    <li <?php echo $page_title=="Admin Index" ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url; ?>admin/index.php">Home</a>
                    </li>

                    <!-- highlight for slider related pages -->
                    <li <?php
                            echo $page_title=="Slider" ? "class='active'" : ""; ?> >
                        <a href="<?php echo $home_url; ?>admin/read_slider.php">slider</a>
                    </li>
                    
                    <!-- highlight for enquiry related pages -->
                    <li <?php
                            echo $page_title=="Enquiries" ? "class='active'" : ""; ?> >
                        <a href="<?php echo $home_url; ?>admin/read_blog.php">Blog</a>
                    </li>
                    <li <?php
                            echo $page_title=="Enquiries" ? "class='active'" : ""; ?> >
                        <a href="<?php echo $home_url; ?>admin/read_comm.php">Comments </a>
                    </li>
                    <li <?php
                            echo $page_title=="Enquiries" ? "class='active'" : ""; ?> >
                        <a href="<?php echo $home_url; ?>admin/read_replies.php">Replies</a>
                    </li>
                    
                    <!-- highlight for Quotation related pages -->
                    <li <?php
                            echo $page_title=="Enquiries" ? "class='active'" : ""; ?> >
                        <a href="<?php echo $home_url; ?>admin/">Research</a>
                    </li>

                    <!-- highlight for Downloads related pages -->
                    <li <?php
                            echo $page_title=="Downloads" ? "class='active'" : ""; ?> >
                        <a href="<?php echo $home_url; ?>admin/read_downloads.php">Downloads</a>
                    </li>
                    <!-- highlight for Teaching related pages -->
                    <li class="nav-item dropdown">
                            <a href="#" class="nav-link text-white dropdown-toggle" id="mydropdown1" data-toggle="dropdown" aria-haspoup="true" aria-expanded="false">Teaching</a>
                            <ul class="dropdown-menu multi-level  dropdown-menu-dark" role="menu" aria-labelledby="dropdownMenu">
                                <li class="dropdown-item">
                                    <a href="read_subject.php">Subject Taught</a>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li class="dropdown-item">
                                    <a href="read_teaching.php">STTP/FDP</a>
                                </li>
                           </ul>
                   </li>    

                    <!-- highlight for Invited Talks related pages -->
                    <li <?php
                            echo $page_title=="Invited Talks" ? "class='active'" : ""; ?> >
                        <a href="<?php echo $home_url; ?>admin/read_invtalks.php">Invited Talks</a>
                    </li>

                    <!-- highlight for Roles and Responsibility related pages -->
                    <li <?php
                            echo $page_title=="Roles and Responsibility" ? "class='active'" : ""; ?> >
                        <a href="<?php echo $home_url; ?>admin/read_roles_responsibility.php">Roles and Responsibility</a>
                    </li>

                       
                </ul>
 
        </div><!--/.nav-collapse -->
 
    </div>
</div>
<!-- /navbar -->