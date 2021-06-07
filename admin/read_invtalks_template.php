<?php

// search form
echo "<form role='search' action='search_invtalks.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type title...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
echo "<br>";
// add User button
echo "<div class='right-button-margin'>";
    echo "<a href='create_invtalks.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Add Invited Talks";
    echo "</a>";
echo "</div>";
if($total_rows>0){
   echo"<div class='table table-responsive'>";
    echo "<table class='table table-hover table-bordered'>";
        echo "<tr>";
            echo "<th>talk_id</th>";
            echo "<th>title</th>";
            echo "<th>organizedby</th>";
            echo "<th>level</th>";
            echo "<th>type</th>";
            echo "<th>fromdate</th>";
            echo "<th>todate</th>";
            echo "<th>Duration</th>";
            echo "<th>unit</th>";
            echo "<th>certificate</th>";
            echo "<th>schedule</th>";
            echo "<th>photo1</th>";
            echo "<th>photo2</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
            
                echo "<td>{$talk_id}</td>";
                echo "<td>{$title}</td>";
                echo "<td>{$organizedby}</td>";
                echo "<td>{$level}</td>";
                echo "<td>{$type}</td>";
                echo "<td>{$fromdate}</td>";
                echo "<td>{$todate}</td>";
                echo "<td>{$Duration}</td>";
                echo "<td>{$unit}</td>";

                echo "<td><a href='pdf/{$certificate}' target='_blank'>certificat</a></td>";
                echo "<td><a href='pdf/{$schedule}' target='_blank'>schedule</a></td>";

                echo "<td width='10%'><a href='img/{$photo1}' target='_blank'><img src='img/{$photo1}' style='width:30%;' ></a></td>";
            
                echo "<td width='10%'><a href='img/{$photo2}' target='_blank'><img src='img/{$photo2}' style='width:30%;' ></a></td>";

              
                echo "<td>";
            
                    // read downloads button
                    echo "<a href='read_one_invtalks.php?id={$talk_id }' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a> &nbsp";
                echo"</td>";

                echo"<td>";
                    // edit downloads button
                    echo "<a href='update_invtalks.php?id={$talk_id }' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a> &nbsp";
                echo"</td>";

                echo"<td>";
                    // delete downloads button
                    echo "<a href='delete_invtalks.php?id={$talk_id }' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a> &nbsp";
                echo"</td>";


 
            echo "</tr>";
 
        }
 
    echo "</table>";
    echo"</div>";

 $page_url="read_invtalks.php?";
    $total_rows = $objinvtalks->countAll();
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No Invited Talks found.</div>";
}
?>
