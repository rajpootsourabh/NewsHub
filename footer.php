<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $conn = mysqli_connect("localhost","root","","news-site") or die("Connection Failed");
                $sql = "SELECT * FROM setting";
                $result = mysqli_query($conn, $sql);
                $array = mysqli_fetch_assoc($result);
                ?>
                <span><?php echo $array['footer_description']; ?></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
