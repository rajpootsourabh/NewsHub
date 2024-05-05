<?php include 'header.php';

 // Variables for Pagination
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1; //Initial value of Page
         }
        $limit = 3;
        $offset = ($page-1)* $limit;

//If search has null value
    if(!empty($_GET['search'])){ 
    $search_keyword = $_GET['search'];

    $sql = "SELECT p.post_id, p.title, p.post_img, p.description , p.post_date, p.author, c.category_id, c.category_name, user.username FROM post p
            LEFT JOIN category c on p.category = c.category_id
            LEFT JOIN user ON p.author = user.user_id WHERE p.title LIKE '%{$search_keyword}%'
            OR p.description LIKE '%{$search_keyword}%' OR user.username LIKE '%{$search_keyword}%' LIMIT $offset, $limit";
    }else{
            echo "<h1 style='margin:20% 40%'>No results found</h1>";
            die();
        }
 ?>

    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading">Search : <?php echo $search_keyword; ?></h2>
                  <?php $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){ ?>

                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href='single.php?pid=<?php echo $row['post_id'];?>'><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
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
                                    <?php echo substr($row['description'],0,250).'......';?></p>
                                    <a class='read-more pull-right' href='single.php?pid=<?php echo $row['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }}
                        else{
                        echo "<h4 style='color:rgb(188, 29, 29)'>No matching results found</h4>";
                            }
                        ?>
                    
                    <ul class='pagination'>
                    <?php
                    $sql1 = "SELECT p.post_id, p.title, p.post_img, p.description , p.post_date, p.author, c.category_id, c.category_name, user.username FROM post p
                    LEFT JOIN category c on p.category = c.category_id
                    LEFT JOIN user ON p.author = user.user_id WHERE p.title LIKE '%{$search_keyword}%'
                    OR p.description LIKE '%{$search_keyword}%' OR user.username LIKE '%{$search_keyword}%'";
                    
                    $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                    $total_records = mysqli_num_rows($result1);
                    $total_page = ceil($total_records/$limit);
                    
                    if($page>1){
                    echo '<li><a href="search.php?search='.$search_keyword.'&page='.($page-1).'">Prev</a></li>';
                    }
                        for($i=1; $i<=$total_page; $i++){
                            if($page==$i){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                    echo '<li class="'.$active.'"><a href="search.php?search='.$search_keyword.'&page='.($i).'">'.($i).'</a></li>';
                    }
                  if($page < $total_page)
                    echo '<li><a href="search.php?search='.$search_keyword.'&page='.($page+1).'">Next</a></li>';
                  ?>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
