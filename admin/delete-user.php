<?php
session_start();
//Preventing from Normal users to delete a user/Admin
if($_SESSION['user_role'] == 0){
  header("Location: http://127.0.0.1/crud/news-template/admin/post.php");
}else{
  $uid = $_GET['id'];
  $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
  $sql = "DELETE FROM user WHERE user_id = {$uid}";
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
  if($result){
    header("Location: http://127.0.0.1/crud/news-template/admin/users.php");
  }}
    mysqli_close($conn);
  ?>