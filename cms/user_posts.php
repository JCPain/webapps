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
                    if(isset($_GET['p_id'])) {
                        $the_post_id = $_GET['p_id'];
                        $the_post_user = $_GET['user'];
                    }
                    $query = "SELECT * FROM posts WHERE post_user = '{$the_post_user}' ";
                    $select_all_posts_query = mysqli_query($connection, $query);
                
                    while($rows = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_title = $rows['post_title'];
                        $post_user = $rows['post_user'];
                        $post_date = $rows['post_date'];
                        $post_image = $rows['post_image'];
                        $post_content = $rows['post_content'];
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    Posts by <?php echo $post_user; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>

                <?php } ?>
            
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>