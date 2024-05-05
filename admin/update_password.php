<?php

// Forgot Password
if(isset($_POST['submit'])){
echo $username = $_POST['username'];
echo $old_password = md5($_POST['old_password']);
echo $new_password = md5($_POST['new_password']);
echo $cnf_password = md5($_POST['cnf_password']);

if($new_password === $cnf_password){
      $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
      $sql = "UPDATE user SET password = '{$new_password}' WHERE username = '{$username}' AND password = '{$old_password}'";
      $result = mysqli_query($conn, $sql);
      if($result){
            header("Location: http://127.0.0.1/crud/news-template/admin");
      }else{
            echo "Password can't be changed";
            header("Location: http://127.0.0.1/crud/news-template/admin/password_mgr.php");
           }
        }
    }
?>