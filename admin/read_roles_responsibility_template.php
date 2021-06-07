<?php

// search form
echo "<form role='search' action='search_roles_responsibility.php'>";
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
    echo "<a href='create_roles_responsibility.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Add Roles & Responsibility";
    echo "</a>";
echo "</div>";
if($total_rows>0){
   echo"<div class='table table-responsive'>";
    echo "<table class='table table-hover table-bordered'>";
        echo "<tr>";
            echo "<th>Role id</th>";
            echo "<th>Name of committee</th>";
            echo "<th>Role</th>";
            echo "<th>Level</th>";
            echo "<th>Academic year</th>";
            echo "<th>Name of Event</th>";
            echo "<th>Letter of Appointment</th>";
            echo "<th>Date of Appointment</th>";
            echo "<th>Descrption of Role</th>";
            echo "<th>Report of Task completed</th>";
            echo "<th>Createdby</th>";
            echo "<th>Modifiedby</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
            
                echo "<td>{$role_id}</td>";
                echo "<td>{$name_commitee}</td>";
                echo "<td>{$role}</td>";
                echo "<td>{$level}</td>";
                echo "<td>{$academic_year}</td>";
                echo "<td>{$name_event}</td>";

                echo "<td><a href='pdf/{$letter_appointment}' target='_blank'>Download</a></td>";

                echo "<td>{$date_appointment}</td>";
                echo "<td>{$desc_role}</td>";
                echo "<td><a href='pdf/{$report_task}' target='_blank'>Download</a></td>";

                echo "<td>{$createdby}</td>";
                echo "<td>{$modifiedby}</td>";

              
                echo "<td>";
            
                    // read downloads button
                    echo "<a href='read_one_roles_responsibility.php?id={$role_id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a> &nbsp";
                echo"</td>";

                echo"<td>";
                    // edit downloads button
                    echo "<a href='update_roles_responsibility.php?id={$role_id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a> &nbsp";
                echo"</td>";

                echo"<td>";
                    // delete downloads button
                    echo "<a href='delete_roles_responsibility.php?id={$role_id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a> &nbsp";
                echo"</td>";


 
            echo "</tr>";
 
        }
 
    echo "</table>";
    echo"</div>";

 $page_url="read_roles_responsibility.php?";
    $total_rows = $objrolres->countAll();
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No Roles & Responsibility found.</div>";
}
?>
