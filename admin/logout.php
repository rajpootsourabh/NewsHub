<?php
$conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
session_start();
session_unset();
session_destroy();

header("Location: http://127.0.0.1/crud/news-template/admin/");


?>
