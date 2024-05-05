<?php include "header.php"; 
if($_SESSION['user_role'] == 0){
    header("Location: http://127.0.0.1/crud/news-template/admin/post.php");
}
?>

<!-- Inserting updated data to the database -->
<?php
    if(isset($_POST['submit'])){
        $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
        $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
        $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
        $user = mysqli_real_escape_string($conn, $_POST['username']); 
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $userid = $_POST['user_id'];
        
         $sql1 = "UPDATE user SET first_name = '{$fname}',last_name = '{$lname}', username = '{$user}', role ={$role} WHERE user_id = {$userid}";
        $result = mysqli_query($conn, $sql1) or die("Query Unsuccessful"); 
        if($result){
        header("Location: http://127.0.0.1/crud/news-template/admin/users.php");
        }else{
            echo "Query Failed";
        }
}
?>

<!-- Code to fetch existing data to update -->
  <?php
  $uid = $_GET['id'];
  $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
  $sql = "SELECT * FROM user WHERE user_id = '{$uid}'";
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
  if(mysqli_num_rows($result)>0){
  ?>


  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php while($row = mysqli_fetch_assoc($result)){ ?>
                  <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST">
                  
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                         <?php if($row['role']==1){
                           echo '<option value="0">Normal User</option>';
                           echo '<option selected value="1">Admin</option>';
                          }else{
                            echo '<option selected value="0">Normal User</option>';
                            echo '<option value="1">Admin</option>';
                          }  ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php }} ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

