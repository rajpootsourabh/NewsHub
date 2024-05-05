<?php
$conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
if(isset($_FILES['fileToUpload']) && isset($_POST['submit']))
{
    $errors = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = (end(explode('.', $file_name)));
    $extensions = array("jpeg", "png", "jpg");

    //Adding time value to the image name to allow uploading duplicate images
    $image_name = time().basename($file_name);

    if(in_array($file_ext, $extensions) === false)
    {
        $errors[] = "Invalid file format, Please select a JPG or PNG file.";
    }

    if($file_size > 3145728)
    {
        $errors[] = "File should be less than 3MB";
    }

    if(empty($errors)== true)
    {
        move_uploaded_file($file_tmp, "upload/".$image_name);
    }else{
         foreach($errors as $errmsg)
                 {
                     echo $errmsg;
                     
                 }die();
         }
}
    session_start();
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date = date("d M, Y");
    $author = $_SESSION['user_id'];

    
    $sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES ('{$title}','{$description}',{$category},'{$date}',{$author},'{$image_name}');";
    
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id ={$category}";

    // Running multiple queries
    
    if(mysqli_multi_query($conn, $sql)){
    header("Location: http://127.0.0.1/crud/news-template/admin/post.php");
    }else{
        echo "<div class='alert alert-danger'>Query Failed.</div>";
    } 

?>

