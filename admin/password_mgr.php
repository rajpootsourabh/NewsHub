<?php
if(isset($_POST['submit'])){
$choice = $_POST['choice'];
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Trouble Login?</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../css/font-awesome.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!-- HEADER -->
        <div id="header-admin">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-2">
                        
                        <a href="post.php"><img class="logo" src="images/news.jpg"></a>
                    </div>
                    <!-- /LOGO -->
                      <!-- LOGO-Out -->
                    <div class="col-md-offset-9  col-md-0">
                        <a href="index.php" class="admin-logout" style="font-size: 16px" >Back to Login</a>
                    </div>
                    <!-- /LOGO-Out -->
                </div>
            </div>
        </div>

        
        <!-- Change Password Form -->
        <?php if($choice == 1){ ?>

        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <h3 class="heading">Change Password</h3>
                        <!-- Form Start -->
                        <form  action="update_password.php" method ="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" name="old_password" class="form-control" placeholder="" required>
                                
                            </div>

                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" placeholder="" required>
                                
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="cnf_password" class="form-control" placeholder="" required>
                                
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary" value="Apply" />
                            <p style="margin: 8px 0px; font-size: 12px;color:red;">Note: Default password for a user is 123</p>
                            
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

        <!--/Change Password Form -->


        
        <!-- Forget Username Form -->
        <?php if($choice == 2){ ?>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <h3 class="heading">Forget Username</h3>
                        <!-- Form Start -->
                        <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="post">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" placeholder="" required>
                                <input type="hidden" name="choice" class="form-control" value="2" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" placeholder="" required>
                                
                            </div>

                            <div class="form-group">
                                <label>User Type</label>

                              <select class="form-control" name="user_type">
                                    <option value="0">Normal User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div> 
                            <input type="submit" name="submit" class="btn btn-primary" value="Get Details"/>
                            <?php 
                            if(isset($_POST['l_name'])!=""){
                                $fname = $_POST['f_name'];
                                $lname = $_POST['l_name'];
                                $user_type = $_POST['user_type'];
                                $choice = $_POST['choice'];
                                $msg = "Your username is ";
                                $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
                                $sql = "SELECT username FROM user WHERE first_name = '{$fname}' AND last_name = '{$lname}'";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <div style="margin: 10px 0px;">
                            <span><?php echo $msg; ?></span><span style="margin: 8px 0px; font-size: 14px;color:red; font-weight:bold;"><?php echo $row['username']; ?> </span>
                            </div>
                                <?php }}else{ ?>  
                                <div><span style="margin: 12px 0px; font-size: 14px;color:red; font-weight:bold;"><?php echo "No records found"; ?> </span></div>
                            <?php }}?>
                                
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
                <?php } ?>
        <!-- /Forget Username Form -->

