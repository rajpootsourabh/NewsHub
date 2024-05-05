<?php include "header.php"; 

// Variables for Pagination
    if(isset($_GET['page'])){
     $page = $_GET['page'];
    }else{
    $page = 1; //Initial value of Page
    }
     $limit = 4;
     $offset = ($page-1)* $limit;

// Only Admin can see all Users and Category Section
    if($_SESSION['user_role'] == 0)
    {
    header("Location: http://127.0.0.1/crud/news-template/admin/post.php");
    }else{
  
// Connection to Database
    $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
//Running Query
  $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT $offset, $limit";
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                     <?php
                            $Serial_number = ($offset+1); //Using offset to print serial number
                            if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){ ?>
                      <tbody>
                            
                          <tr>
                              <td class='id'><?php echo $Serial_number; ?></td>
                              <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php if($row['role']==1){echo "Admin";}else{echo "Normal";} ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                      </tbody>
                      <?php $Serial_number++; } ?>                  
                  </table>
                  
                  <ul class='pagination admin-pagination'>
                    <!-- Pagination starts from here -->
                    <?php
                    $sql1 = "SELECT * FROM user";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                    $total_records = mysqli_num_rows($result1);
                    $total_page = ceil($total_records/$limit);
                    
                    if($page>1){
                    echo '<li><a href="users.php?page='.($page-1).'">Prev</a></li>';
                    }
                        for($i=1; $i<=$total_page; $i++){
                            if($page==$i){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                    echo '<li class="'.$active.'"><a href="users.php?page='.($i).'">'.($i).'</a></li>';
                    }
                  if($page < $total_page)
                    echo '<li><a href="users.php?page='.($page+1).'">Next</a></li>';
                  ?>
                  </ul>
                  <!-- Pagination ends here -->
              </div>
          </div>
      </div>
  </div>
  <?php } ?>
<?php include "footer.php"; ?>
<?php } ?>