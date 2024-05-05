 <?php include 'header.php';
 $author = $_GET['author'];

 // Variables for Pagination
if(isset($_GET['page'])){
    $page = $_GET['page'];
   }else{
   $page = 1; //Initial value of Page
   }
    $limit = 2;
    $offset = ($page-1)* $limit;
 
 $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
 $sql = "SELECT p.post_id, p.title, p.post_img,p.description ,p.post_date,p.author, c.category_id,c.category_name, user.username FROM post p
 LEFT JOIN category c on p.category = c.category_id
 LEFT JOIN user ON p.author = user.user_id WHERE p.author = {$author} LIMIT $offset, $limit";
 $result = mysqli_query($conn, $sql);
 ?>

    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                <?php
                $sql1 = "SELECT * FROM user WHERE user_id = {$author}";
                $result1 = mysqli_query($conn, $sql1);
                while($row1 = mysqli_fetch_assoc($result1)){ ?>
                  <h2 class="page-heading"><?php echo $row1['username'];?></h2> 
                
                <?php }
                if(mysqli_num_rows($result)>0){
                 while($row = mysqli_fetch_assoc($result)){ ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?pid=<?php echo $row['post_id'];?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?pid=<?php echo $row['post_id'];?>'><?php echo $row['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category_id'];?>'><?php echo $row['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?author=<?php echo $row['author'];?>'><?php echo $row['username'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date'];?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row['description'],0,120).'......';?></p>
                                    <a class='read-more pull-right' href='single.php?pid=<?php echo $row['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }} ?>

                    <!-- Show Pagination -->
                    <ul class='pagination'>
                    <?php
                    $sql2 = "SELECT * FROM post WHERE author = {$author}";
                    
                    $result2 = mysqli_query($conn, $sql2) or die("Query Failed");
                    $total_records = mysqli_num_rows($result2);
                    $total_page = ceil($total_records/$limit);
                    
                    if($page>1){
                    echo '<li><a href="author.php?author='.$author.'&page='.($page-1).'">Prev</a></li>';
                    }
                        for($i=1; $i<=$total_page; $i++){
                            if($page==$i){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                    echo '<li class="'.$active.'"><a href="author.php?author='.$author.'&page='.($i).'">'.($i).'</a></li>';
                    }
                  if($page < $total_page)
                    echo '<li><a href="author.php?author='.$author.'&page='.($page+1).'">Next</a></li>';
                  ?>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
