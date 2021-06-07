<?php
include_once "top.php";

include_once "menu.php";

include_once "slider.php";
?>
<!-- First Grid -->
    <div style="background-color: #d8e3e7;" class="w3-row-padding w3-padding-64 w3-container">
        <div  class="w3-content">
            <div class="w3-twothird">
                <h1 style=" font-family: 'Montserrat', sans-serif; font-size: 4.0rem;  font-weight: bold; color: #424a4d;">
                    About Author</h1>
                <h5 style=" font-family: 'Montserrat', sans-serif; font-size: 1.5rem; color: #424a4d;" class="w3-padding-32">
                    Dr. Yuvraj  Parkale is very young and dynamic personality. He has completed his PhD in E&TC. Now he is working as Assistant professor. Along with this 
                    his work in research is immence and vital. <a href="about.html" style="color:Blue"> Read More</Read></a></h5>
                
            </div>
            
            <div class="w3-third w3-center">
            <?php
                include_once "latestPublications.php";
            ?>
            
                 
                <!--<i class="fa fa-anchor w3-padding-64 w3-text-red"></i>-->
            </div>
        </div>
    </div>
    <!-- Second Grid -->
    <div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
        <div class="w3-content">
            <div class="w3-third w3-center">
                <i class="fa fa-coffee w3-padding-64 w3-text-red w3-margin-right"></i>
            </div>
            <div class="w3-twothird">
                <h1>Teaching Career
                    </h1>
                
                <p class="w3-text-grey">
                   During the experience of 15 years Dr. Yuvraj Parkale taught to undergraduate as well as post graduate students.
                   <br />For PG  (M.E. Electronics (Digital Systems))- He taught Advanced DSP, Research Methodology, Business Analytics. 
                   <br />For UG(E&TC)- He taught  Advanced Processor, Embedded Processors, Embedded System Design (Elective-I), Microcontrollers 
                   <a href="teaching.php" style="color:Blue"> Read More</Read></a>

                   </p>
            </div>
        </div>
    </div>
<?php
include_once "bottom.php";

?>