<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>

        <?php
        //Connect to Database
        $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
        $sql = "SELECT p.post_id, p.title, p.author, c.category_id,c.category_name, p.post_date, user.username,post_img,description FROM post p
        LEFT JOIN category c on p.category = c.category_id
        LEFT JOIN user ON p.author = user.user_id ORDER BY p.post_id DESC LIMIT 4";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)> 0 ){
            while($row = mysqli_fetch_assoc($result)){
        ?>

        <div class="recent-post">
            <a class="post-img" href="single.php?pid=<?php echo $row['post_id'];?>">
                <img src="admin/upload/<?php echo $row['post_img'];?>" alt="error loading image"/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?pid=<?php echo $row['post_id'];?>"><?php echo $row['title'];?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='author.php?author=<?php echo $row['author'];?>'><?php echo $row['username'];?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $row['post_date'];?>
                </span>
                <a class="read-more" href="single.php?pid=<?php echo $row['post_id'];?>">read more</a>
            </div>
        </div>
        <?php }}?>
    
    </div> 
    <!-- /recent posts box -->
</div>
