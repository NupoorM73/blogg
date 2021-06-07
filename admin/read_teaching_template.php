<?php

// search form
echo "<form role='search' action='search_teaching.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type course or title...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
echo "<br>";
// add User button
echo "<div class='right-button-margin'>";
    echo "<a href='create_teaching.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Add teaching";
    echo "</a>";
echo "</div>";
echo "</br>";
echo "</br>";
if($total_rows>0){
 
   echo"<div class='table-responsive'>";
    echo "<table class='table table-hover table-bordered'>";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Title</th>";
            echo "<th>Organized By</th>";
            echo "<th>Level</th>";
            echo "<th>From date</th>";
            echo "<th>To date</th>";
            echo "<th>Duration</th>";
             echo "<th>certificate</th>";
             echo "<th>schudule</th>";
             echo "<th>photo1</th>";
              echo "<th>photo2</th>";
              

        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
            
                echo "<td>{$id}</td>";
                echo "<td>{$title}</td>";
                echo "<td>{$organized_by}</td>";
                echo "<td>{$level}</td>";
                echo "<td>{$from_date}</td>";
                echo "<td>{$to_date}</td>";
                echo "<td>{$duration}</td>";
                echo "<td><a href='pdf/{$certificate}' target='_blank'>certificate</a></td>";

                //echo "<td width='10%'><a href='img/{$certificate}' target='_blank'><img src='img/{$certificate}' style='width:30%;' ></a></td>";
               // echo "<td><a href='pdf/{$pdf}' target='_blank'>Download</a></td>";
                echo "<td><a href='pdf/{$schudule}' target='_blank'>schudule</a></td>";
                // echo "<td width='10%'><a href='img/{$schudule}' target='_blank'><img src='img/{$schudule}' style='width:30%;' ></a></td>";
                echo "<td width='10%'><a href='img/{$photo1}' target='_blank'><img src='img/{$photo1}' style='width:30%;' ></a></td>";
                echo "<td width='10%'><a href='img/{$photo2}' target='_blank'><img src='img/{$photo2}' style='width:30%;' ></a></td>";
               
 
                    // read downloads button
                    echo "<td>";
                    echo "<a href='read_one_teaching.php?id={$id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read ";
                    echo "</a> &nbsp";
                    echo "</td>";
 
                    // edit downloads button
                    echo "<td>";
                    echo "<a href='update_teaching.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a> &nbsp";
                    echo "</td>";
                    // delete downloads button
                    echo "<td>";
                    echo "<a href='delete_teaching.php?id={$id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a> &nbsp";
                    echo "</td>";
 
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
    echo"</div>";
 $page_url="read_downloads.php?";
    $total_rows = $objteaching->countAll();
    // paging buttons
    include_once 'paging_teacher.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No teaching found.</div>";
}
?>
