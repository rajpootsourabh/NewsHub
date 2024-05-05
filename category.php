<?php include 'header.php';

//Fetching value for category
$cat_id = $_GET['cid'];

// Variables for Pagination
if(isset($_GET['page'])){
    $page = $_GET['page'];
   }else{
   $page = 1; //Initial value of Page
   }
    $limit =2;
    $offset = ($page-1)* $limit;

//Connect to Database
    $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
    $sql="SELECT category_name FROM category WHERE category_id = {$cat_id}";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">

                <!-- post-container -->
                <div class="post-container">
                    <!-- Fetching Category Name -->
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <h2 class="page-heading"><?php echo $row['category_name'];?></h2>
                    <?php } ?>
                    <!-- -------------------------------------------------- -->

                    <?php
                    $sql1 = "SELECT p.post_id, p.title,p.author, c.category_id,c.category_name, c.post, p.post_date, user.username,post_img,description FROM post p
                    LEFT JOIN category c on p.category = c.category_id
                    LEFT JOIN user ON p.author = user.user_id WHERE category={$cat_id} ORDER BY p.post_id DESC LIMIT $offset, $limit";

                    $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                    if(mysqli_num_rows($result1)>0){
                    while($row1 = mysqli_fetch_assoc($result1)){
                    ?>

                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?pid=<?php echo $row1['post_id'];?>"><img src="admin/upload/<?php echo $row1['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="single.php?pid=<?php echo $row1['post_id'];?>"><?php echo $row1['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row1['category_id'];?>'><?php echo $row1['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?author=<?php echo $row1['author'];?>'><?php echo $row1['username'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row1['post_date'];?></span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row1['description'],0,204).'......';?>                                    </p>
                                    <a class='read-more pull-right' href='single.php?pid=<?php echo $row1['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }}?>

                    <!-- Show Pagination -->
                    <ul class='pagination'>
                    <?php
                    $sql2 = "SELECT * FROM post WHERE category = {$cat_id}";
                    
                    $result2 = mysqli_query($conn, $sql2) or die("Query Failed");
                    $total_records = mysqli_num_rows($result2);
                    $total_page = ceil($total_records/$limit);
                    
                    if($page>1){
                    echo '<li><a href="category.php?cid='.$cat_id.'&page='.($page-1).'">Prev</a></li>';
                    }
                        for($i=1; $i<=$total_page; $i++){
                            if($page==$i){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                    echo '<li class="'.$active.'"><a href="category.php?cid='.$cat_id.'&page='.($i).'">'.($i).'</a></li>';
                    }
                  if($page < $total_page)
                    echo '<li><a href="category.php?cid='.$cat_id.'&page='.($page+1).'">Next</a></li>';
                  ?>
                  
                   </ul><!-- Pagination ends here -->
                   
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
