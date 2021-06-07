<?php

// search form

// add User button
echo "<div class='right-button-margin'>";
    echo "<a href='create_slider.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Upload Image";
    echo "</a>";
echo "</div>";

if($total_rows>0){
 

    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>id</th>";
            echo "<th>image</th>";


        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
            
                echo "<td>{$id}</td>";
                echo "<td>{$image}</td>";
            
              
                //echo "<td width='10%'><a href='img/{$image}' target='_blank'><img src='img/{$image}' style='width:30%;' ></a></td>";
                
                
               
 
                    // read downloads button
                   
                    echo "<td>";
                    // delete downloads button
                    if($softdelete==1){
                    echo "<a href='delete_slider.php?id={$id}' class='btn btn-success delete-object'>";
                        echo "<span class='glyphicon glyphicon-ok'></span> Active";
                    echo "</a> &nbsp";
                    }
                    else{
                        echo "<a href='delete_slider.php?id={$id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Inactive";
                    echo "</a> &nbsp";

                    }
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
 $page_url="read_slider.php?";
    $total_rows = $objslider->countAll();
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No Records found.</div>";
}
?>
