<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php
    //Set Dynamic Website Name
    $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
    $sql = "SELECT * FROM setting";
    $result = mysqli_query($conn, $sql);
    $array = mysqli_fetch_assoc($result);
    echo '<title>'.$array['website_name'].'</title>'; 
    ?>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="admin/images/<?php echo $array['website_logo']; ?>"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<?php
if(isset($_GET['cid'])){
$cat_id = $_GET['cid'];
}
$conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
$sql = "SELECT * FROM category";
$result= mysqli_query($conn, $sql) or die("Query Failed");
if(mysqli_num_rows($result)>0){
    $active = "";
?>
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                <li><a  href="http://127.0.0.1/crud/news-template/">Home</a></li>
                    <?php
                    
                    while($row = mysqli_fetch_assoc($result)){
                        if(isset($_GET['cid'])){
                            $cat_id = $_GET['cid'];
                        if($row['category_id']== $cat_id){
                            $active = "active";
                        }else{
                            $active = "";
                        }}
                    echo "<li><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                    }} ?>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
