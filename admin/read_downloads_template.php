<?php

// search form
echo "<form role='search' action='search_downloads.php'>";
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
    echo "<a href='create_download.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Add Downloads";
    echo "</a>";
echo "</div>";

if($total_rows>0){
 

    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Title</th>";
            echo "<th>Course</th>";
            echo "<th>PDF</th>";
            echo "<th>Image</th>";
            echo "<th>PPT</th>";
            echo "<th>Video Link</th>";
             echo "<th>Uploaded Date</th>";

        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
            
                echo "<td>{$download_id}</td>";
                echo "<td>{$title}</td>";
                echo "<td>{$course}</td>";
                echo "<td><a href='pdf/{$pdf}' target='_blank'>Download</a></td>";
                echo "<td width='10%'><a href='img/{$img}' target='_blank'><img src='img/{$img}' style='width:30%;' ></a></td>";
                echo "<td><a href='ppt/{$ppt}' target='_blank'>Download</a></td>";
                echo "<td><a href='{$video_link}' target='_blank'>Click Here</a></td>";
                $date=date_create($created);
                $newDate= date_format($date, "d-m-Y");
                
                echo "<td> {$newDate}</td>";
                echo "<td>";
 
                    // read downloads button
                    echo "<a href='read_one_download.php?id={$download_id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read ";
                    echo "</a> &nbsp";
 
                    // edit downloads button
                    echo "<a href='update_download.php?id={$download_id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a> &nbsp";
 
                    // delete downloads button
                    echo "<a href='delete_download.php?id={$download_id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a> &nbsp";
 
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
 $page_url="read_downloads.php?";
    $total_rows = $objDownloads->countAll();
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No Downoads found.</div>";
}
?>
