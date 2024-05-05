<?php
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_role']==1){
$web_name = $_POST['web_name'];
$footer_desc = $_POST['footer_desc'];

if(empty($_FILES['new-image']['name'])){
$logo = $_POST['old-image']; //old image 
}else{
$file_name = $_FILES['new-image']['name']; //new image
$tmp_name = $_FILES['new-image']['tmp_name'];
$file_type = end(explode('.', $file_name));
$extensions = array("jpeg", "png", "jpg");
$logo = time().basename($file_name);

if(in_array($file_type, $extensions) === false)
    {
        $error = "Only jpg and png files are allowed";
        }else{
            if(empty($error)==true){
            move_uploaded_file($tmp_name, "images/".$logo);
        }else{
            echo '<h4>$error</h4>';
             }
    }
}

$conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
$sql = "UPDATE setting SET website_name ='{$web_name}', footer_description = '{$footer_desc}', website_logo = '{$logo}'";
$result = mysqli_query($conn, $sql);

if($result){
    header("Location: http://127.0.0.1/crud/news-template/admin/setting.php");
}else{
      echo "Failed to update";
     }
}else{
    echo "<h1 style='margin:24% 43%; color:red'>Acess Denied!</h1>";
}
?>
