<?php include "header.php"; 
if($_SESSION['user_role'] == 0){
    header("Location: http://127.0.0.1/crud/news-template/admin/post.php");

}else{
    $cid = $_GET['id'];
    $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
    $sql = "SELECT * FROM category WHERE category_id = {$cid}";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
    if(mysqli_num_rows($result)>0){

}
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <!-- Form starts here -->
                  <form action="save-update category.php" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" onclick="return msg()" required />
                  </form>
                  <?php }} ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
<script>
    function msg(){
        alert("Category Successfully Updated");
        return true;
    }
</script>