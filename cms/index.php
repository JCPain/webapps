<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                
                    # PAGINATION
                    $per_page = 5;
                    # CHECK IF PAGE KEY IS PRESENT
                    if(isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = "";
                    }
                
                    if($page == "" || $page == 1) {
                        $page_1 = 0; // IF PAGE IS EMPTY OR IS EQUAL TO 1 START AT 0 INDEX
                    } else {
                        $page_1 = ($page * $per_page) - $per_page; // IF NOT 0 OR 1 INDEX E.G. (2,3) MULTIPLY AND START AT 4 INDEX (ARRAY STARTS AT 0).
                    }
                    
                    # COUNT TOTAL ROWS INSIDE POSTS TABLE AND DIVIDE BY 5 THEN ROUND UP TO PREVENT DECIMAL VALUE
                    $post_query_count = "SELECT * FROM posts ";
                    $find_count = mysqli_query($connection, $post_query_count);
                    $count = mysqli_num_rows($find_count);
                    $count = ceil($count / $per_page); // DIVIDE TOTAL ROWS BY 5 (5 POSTS PER PAGE)
                
                    # DISPLAY POSTS
                    $query = "SELECT * FROM posts LIMIT {$page_1}, {$per_page} "; // if true 0-4, else 4-9, 9-14...
                    $select_all_posts_query = mysqli_query($connection, $query);
                
                    while($rows = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_id = $rows['post_id'];
                        $post_title = $rows['post_title'];
                        //$post_author = $rows['post_author'];
                        $post_user = $rows['post_user'];
                        $post_date = $rows['post_date'];
                        $post_image = $rows['post_image'];
                        $post_content = substr($rows['post_content'], 0, 400);
                        $post_status = $rows['post_status'];
                        
                    if($post_status === 'published') {
                ?>

<!--
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
-->
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="user_posts.php?user=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

               <?php }} ?>
           
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->
       
        <hr>

        <ul class="pager">
            <?php 
                for($i = 1; $i <= $count; $i++) {
                    if($i == $page) {
                        echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a>";
                    } else {
                        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                    }
                }
            ?>
        </ul>

<?php include "includes/footer.php"; ?>