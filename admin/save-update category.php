<?php
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    
    $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
    $sql = "UPDATE category SET category_name='{$cat_name}' WHERE category_id = {$cat_id}";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
    if($result){
        header("Location: http://127.0.0.1/crud/news-template/admin/category.php"); 
    }
?>