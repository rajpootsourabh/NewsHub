<?php include "header.php"; 
  $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");

    if(isset($_POST['save'])){
    $cat = mysqli_real_escape_string($conn, $_POST['cat']);
    $sql = "INSERT INTO category(category_name) VALUES ('{$cat}')";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
    if($result)
    {
        echo '<script>alert("Category Successfully Added");</script>';
    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
