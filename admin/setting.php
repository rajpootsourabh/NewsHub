<?php include "header.php";
 if(isset($_SESSION['user_role'])==1){

$conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
 $sql = "SELECT * FROM setting";
 $result = mysqli_query($conn, $sql);
 if(mysqli_num_rows($result)>0){
 $row = mysqli_fetch_assoc($result); //if single record is to display then no need to use while loop....
?>  

<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Web Setting</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">

        <!-- Form for show edit-->
        <form action="save_setting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="web_name">Website Name</label>
                <input type="text" name="web_name"  class="form-control" id="exampleInputUsername" value="<?php echo $row['website_name'];?>">
            </div>
            
            <div class="form-group">
                <label for="">Website Logo</label>
                <input type="file" name="new-image">
                <img  src="images/<?php echo $row['website_logo'];?>">
                <input type="hidden" name="old-image" value="<?php echo $row['website_logo'];?>">
            </div>

            <div class="form-group">
                <label for="footer_desc">Footer Description</label>
                <textarea name="footer_desc" class="form-control"  required rows="5"><?php echo $row['footer_description'];?>
                </textarea>
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" onclick="return msg()" />
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php } } ?>
<?php include "footer.php"; ?>

<!-- Display Message -->
<script>
    function msg(){
        alert("Settings have been updated");
        return true;
    }
</script>

