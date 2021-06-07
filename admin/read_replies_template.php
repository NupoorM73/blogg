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
$Comment = new Comment($db);
$reply = new Replies($db);

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


if($total_rows>0){
 

    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Post ID</th>";
            echo "<th>Title</th>";
            echo "<th>Title Description</th>";
            echo "<th>Name</th>";
            echo "<th>Reply</th>"; 
            echo "<th>Replied On</th>"; 
            // echo "<th>Image</th>";
            //echo "<th>Created</th>";  echo "<th>Modified</th>";
             

        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
            
                echo "<td>{$post_id}</td>";
                echo "<td>{$title}</td>";
                echo "<td style='width:10%;'>{$titledes}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$body}</td>";
                echo "<td>{$created_at}</td>";


                echo "<td>";
 
                    // read downloads button
                    // echo "<a href='read_one_blog.php?comment_id={$comment_id}' class='btn btn-primary left-margin'>";
                    //     echo "<span class='glyphicon glyphicon-list'></span> Read ";
                    // echo "</a> &nbsp";
 
                    // edit downloads button
                    echo "<a href='update_reply.php?reply_id={$reply_id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Add Reply";
                    echo "</a> &nbsp";
 
                    // delete downloads button
                    echo "<a href='delete_reply.php?reply_id={$reply_id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a> &nbsp";
 
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
 $page_url="read_replies.php?";
    $total_rows = $reply->countAllc();
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No replies found.</div>";
}
?>
