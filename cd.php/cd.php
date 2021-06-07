    <?php
$conn = new mysqli("localhost","root", "", "slider");

$msg = '';
if(isset($_POST['upload']))
{
    $image = $_FILES['image']['name'];
    $path = 'images/'.$image;

    $sql = $conn->query("INSERT INTO img (sliderimg) VALUES ('$path')");

    if($sql){
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        $msg = 'Image uploades successfully';
    }
    else{
            $msg = 'Image upload failed!';
    }
    $result = $conn->query("SELECT sliderimg FROM img");    
}
?>