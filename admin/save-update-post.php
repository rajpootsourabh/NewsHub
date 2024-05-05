<?php
if(empty($_FILES['new-image']['name']))
{
$image_name = $_POST['old-image'];
}else{
        $errors = array();
        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
        $file_ext = (end(explode('.', $file_name)));
        $extensions = array("jpeg", "png", "jpg");

        //Adding time value to the image name to allow uploading duplicate images.
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

    $pid = $_POST['post_id'];
    $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $sql = "UPDATE post SET title='{$title}', description ='{$description}', category= {$category}, post_img = '{$image_name}' WHERE post_id = {$pid}";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
    if($result){
      header("Location: http://127.0.0.1/crud/news-template/admin/post.php"); 
    }   
?>
