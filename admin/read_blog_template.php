<?php


include_once '../config/database.php';
include_once '../objects/blogpost.php';
include_once '../objects/comments.php';
include_once '../objects/user.php';
include_once '../objects/replies.php';
include_once '../objects/image.php';

$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$post = new Post($db);
$img = new Image($db);

// $stmtt = $img->readOne();
// $rowi = $stmtt->fetch(PDO::FETCH_ASSOC);
// extract($rowi);

// $stmt=$post->readAll();

// search form
echo "<form role='search' action='search_blog.php'>";
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
    echo "<a href='writeblog.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Add Blog";
    echo "</a>";
echo "</div>";

if($total_rows>0){
 

    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Post ID</th>";
            echo "<th>Title</th>";
            echo "<th>Title Description</th>";
            // echo "<th>Image 1</th>";
            // echo "<th>Image 2</th>";
           
           
            echo "<th>Link</th>";
            echo "<th>PDF</th>";
            echo "<th>PPT</th>";
            // echo "<th>Image</th>";
            //echo "<th>Created</th>";  echo "<th>Modified</th>";
             

        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
            
                echo "<td>{$post_id}</td>";
                echo "<td>{$title}</td>";
                echo "<td style='width:10%;'>{$titledes}</td>";
                // echo "<td width='10%'><a href='../uploads/image/{$imageid1}' target='_blank'><img src='../uploads/image/{$imageid1}' style='width:30%;' ></a></td>";
                // echo "<td width='10%'><a href='../uploads/image/{$imageid2}' target='_blank'><img src='../uploads/image/{$imageid2}' style='width:30%;' ></a></td>";
                // echo "<td width='10%'><a href='..uploads/image/{$imageid3}' target='_blank'><img src='../uploads/image/{$imageid3}' style='width:30%;' ></a></td>";
               // echo "<td>{$publicationdate}</td>";
                //echo "<td>{$description}</td>";
                echo "<td><a href='{$link}' target='_blank'>Link</a></td>";
                echo "<td><a href='../uploads/pdf/{$pdf}' target='_blank'>Download</a></td>";
                // echo "<td width='10%'><a href='img/{$img}' target='_blank'><img src='img/{$img}' style='width:30%;' ></a></td>";
                echo "<td><a href='../uploads/ppt/{$ppt}' target='_blank'>Download</a></td>";
               //  echo "<td>{$created}</td>";
                

                //  $date=date_create($created);
                // $newDate= date_format($date, "d-m-Y");
                // echo "<td> {$newDate}</td>";

                 //echo "<td>{$modified}</td>";
                echo "<td>";
 
                    // read downloads button
                    echo "<a href='read_one_blog.php?post_id={$post_id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read ";
                    echo "</a> &nbsp";
 
                    // edit downloads button
                    echo "<a href='update_blog.php?post_id={$post_id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a> &nbsp";
 
                    // delete downloads button
                    echo "<a href='delete_blog.php?post_id={$post_id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a> &nbsp";
 
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
 $page_url="read_blog.php?";
    $total_rows = $post->countAll();
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No Blog found.</div>";
}
?>
