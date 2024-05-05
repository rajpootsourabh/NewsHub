<?php include "header.php";

// Variables for Pagination
if(isset($_GET['page'])){
    $page = $_GET['page'];
   }else{
   $page = 1; //Initial value of Page
   }
    $limit = 4;
    $offset = ($page-1)* $limit;


// All post will be accessible only to admin
if($_SESSION['user_role']==0)
{
    $sql = "SELECT p.post_id, p.title, c.category_id,c.category_name, p.post_date, user.username FROM post p
    LEFT JOIN category c on p.category = c.category_id
    LEFT JOIN user ON p.author = user.user_id WHERE user.user_id = {$_SESSION["user_id"]} ORDER BY p.post_id DESC LIMIT $offset, $limit";
}
else{
    $sql = "SELECT p.post_id, p.title, c.category_id,c.category_name, p.post_date, user.username FROM post p
    LEFT JOIN category c on p.category = c.category_id
    LEFT JOIN user ON p.author = user.user_id ORDER BY p.post_id DESC LIMIT $offset, $limit";
    }
// ends here


$conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
$result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){

}
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php 
                        $Serial_number = ($offset+1); //Using offset to print serial number
                        while($row = mysqli_fetch_assoc($result))
                               {   
                        ?>
                          <tr>
                              <td class='id'><?php echo $Serial_number ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']; ?>&catid=<?php echo $row['category_id']; ?>' onclick="return msg()"><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php $Serial_number++ ;} ?>

                      </tbody>
                  </table>
                  <ul class='pagination admin-pagination'>
                    <!-- Pagination starts from here -->
                    <?php
                    $sql2 = "SELECT * FROM post";
                    $result2 = mysqli_query($conn, $sql2) or die("Query Failed");
                    $total_records = mysqli_num_rows($result2);
                    $total_page = ceil($total_records/$limit);
                    
                    if($page>1){
                    echo '<li><a href="post.php?page='.($page-1).'">Prev</a></li>';
                    }
                        for($i=1; $i<=$total_page; $i++){
                            if($page==$i){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                    echo '<li class="'.$active.'"><a href="post.php?page='.($i).'">'.($i).'</a></li>';
                    }
                  if($page < $total_page)
                    echo '<li><a href="post.php?page='.($page+1).'">Next</a></li>';
                  ?>
                  </ul>
                  <!-- Pagination ends here -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

<!-- Alert message -->
<script>
    function msg(){
        alert("Post Successfully Deleted");
        return true;
    }
</script>
