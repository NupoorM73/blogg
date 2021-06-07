<?php

//echo "Search";
// core.php holds pagination variables
include_once '../config/core.php';
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/blogpost.php';
include_once '../objects/comments.php';
include_once '../objects/user.php';
include_once '../objects/replies.php';
include_once '../objects/image.php';

// instantiate database and downloads object
$database = new Database();
$db = $database->getConnection();
 
$post = new Post($db);

// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
 
$page_title = "You searched for \"{$search_term}\"";
include_once "layout_head.php";
 
// query products
echo "<div class='col-md-12'>";

    $stmt = $post->search($search_term, $from_record_num, $records_per_page);
    
    // specify the page where paging is used
    $page_url="search_blog.php?s={$search_term}";
     $num = $stmt->rowCount();
    // count total rows - used for pagination
    $total_rows=$num;
    //$num=$user->countAll_BySearch($search_term);
     //echo $num;
    // read_template.php controls how the product list will be rendered
    include_once "read_blog_template.php";
 
 echo "</div>";
// layout_footer.php holds our javascript and closing html tags
include_once "layout_foot.php";
?>