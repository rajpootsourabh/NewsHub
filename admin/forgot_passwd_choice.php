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


        <!-- User Choice -->

        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <h3 class="heading" style="color:#307bf0;">Trouble Logging In</h3>
                        <!-- Form Start -->
                        <form  action="password_mgr.php" method ="post">
                            <div class="form-group">
                                <select class="form-control" name="choice">
                                    <option value="1">Change/Update Login Password</option>
                                    <option value="2">Forgot Username</option>
                                    <!-- <option value="3">Forgot Login Password</option> -->
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Next"/>                            
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
