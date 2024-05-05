<?php include "header.php";
$uid = $_SESSION['user_id'];
$pid = $_GET['id'];
$conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");

// Preventing deletion of records from Normal Users
if($_SESSION['user_role']==0 ){
 $sql = "SELECT * FROM post WHERE post_id = {$pid} AND author = {$uid}";
}else{
    $sql = "SELECT * FROM post WHERE post_id = {$pid}";
}
 $result = mysqli_query($conn, $sql);
 if(mysqli_num_rows($result)>0){
?>  


<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">



        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">

            <!-- Fetching Values from Database -->
            <?php 
                while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5"><?php echo $row['description']; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                
                    <?php
                    echo '<select class="form-control" name="category">';
                    $sql2 = "SELECT * FROM category";
                    $result2 = mysqli_query($conn, $sql2);
                    if(mysqli_num_rows($result2)>0)
                    {
                      while($row2 = mysqli_fetch_assoc($result2))
                        {
                            if($row['category'] == $row2['category_id'])
                        {
                            $select = "selected";
                        }else
                        {
                            $select = "";
                        }
                
                     echo "<option {$select} value='{$row2['category_id']}'>{$row2['category_name']}</option>";
                    }} ?>
                    </select>
                    
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
            </div>
            
            <input type="submit" name="submit" class="btn btn-primary" value="Update" onclick="return msg()" />
        </form>
        <!-- Form End -->
        <?php }} 
        else{
            echo "You don't have right to access this file";
            }
        ?>

      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>

<script>
    function msg(){
        alert("Post Successfully Updated");
        return true;
    }
</script>

