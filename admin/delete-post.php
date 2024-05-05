<?php
 session_start();
  if(isset($_SESSION['username'])){
  $pid = $_GET['id'];
  $uid = $_SESSION['user_id'];
  $catid = $_GET['catid'];

  $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");

  if($_SESSION['user_role']==0){
  // Query to Get image from database
  $sql1 = "SELECT * FROM post WHERE post_id = {$pid} AND author = {$uid}";

  // Query to Delete post from database
  $sql = "DELETE FROM post WHERE post_id = {$pid} AND author = {$uid};";

    // Query to Update category in database
  $sql .= "UPDATE category SET post = post -1 WHERE category_id ={$catid}";
}else{
  // Query to get image from database
  $sql1 = "SELECT * FROM post WHERE post_id = {$pid}";

    //Query to  Delete post from database
  $sql = "DELETE FROM post WHERE post_id = {$pid};";

  // Update category in database
  $sql .= "UPDATE category SET post = post -1 WHERE category_id ={$catid}";
}

  $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
  $row = mysqli_fetch_assoc($result1);

  // Delete image/file from database
  unlink("upload/".$row['post_img']);

  $result = mysqli_multi_query($conn, $sql) or die("Query Unsuccessful");
  if($result && $result1){
    header("Location: http://127.0.0.1/crud/news-template/admin/post.php");
    mysqli_close($conn);
}else{
        echo "Query Failed";
     } 
}
  ?>