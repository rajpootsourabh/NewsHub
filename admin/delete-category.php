<?php
session_start();
//Preventing from Normal users to delete a user/Admin
if($_SESSION['user_role'] == 0){
  header("Location: http://127.0.0.1/crud/news-template/admin/post.php");
}else{
  $cat_id = $_GET['id'];
  $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
  $sql = "DELETE FROM category WHERE category_id = {$cat_id}";
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
  if($result){
    header("Location: http://127.0.0.1/crud/news-template/admin/category.php");
  }else{
    echo "Failed to Delete";
  }
}
    mysqli_close($conn);
  ?>