
<?php include "includes/admin_header.php"; ?>
    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <!-- /#page-wrapper -->
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Comments
                        <small>Author</small>
                    </h1>
                    
                    <?php 
                        if(isset($_POST['checkBoxArray'])) {
                            foreach($_POST['checkBoxArray'] as $commentValueId) {
                                $bulkOptions = $_POST['bulk_options'];

                                switch($bulkOptions) {
                                    case 'approved':
                                        $query = "UPDATE comments SET comment_status = '{$bulkOptions}' WHERE comment_id = {$commentValueId} ";
                                        $update_to_approved_status = mysqli_query($connection, $query);

                                        confirmQuery($update_to_approved_status); 
                                    break;

                                    case 'unapproved':
                                        $query = "UPDATE comments SET comment_status = '{$bulkOptions}' WHERE comment_id = {$commentValueId} ";
                                        $update_to_unapproved_status = mysqli_query($connection, $query);

                                        confirmQuery($update_to_unapproved_status); 
                                    break;

                                    case 'delete':
                                        $query = "DELETE FROM comments WHERE comment_id = {$commentValueId} ";
                                        $update_to_delete = mysqli_query($connection, $query);

                                        confirmQuery($update_to_delete); 
                                    break;
                                }
                            }
                        }

                    ?>

                    <div class="table-responsive">
                        <form action="" method="post">
                            <div id="bulkOptionContainer" class="col-xs-4 space">

                                <select class='form-control' name="bulk_options" id="">
                                    <option value="">Select Option</option>
                                    <option value="approved">Approve</option>
                                    <option value="unapproved">Unapprove</option>
                                    <option value="delete">Delete</option>
                                </select>

                            </div>
                            <div class="col-xs-6 space">
                                <input type="submit" class='btn btn-success' value='Apply'>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><input id='selectAllBoxes' type="checkbox"></th>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Comment</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>In Response to</th>
                                        <th>Date</th>
                                        <th>Approve</th>
                                        <th>Unapprove</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $the_post_id = $_GET['id'];
                                    $query = "SELECT * FROM comments ";
                                    $query .= "WHERE comment_post_id = " . mysqli_real_escape_string($connection, $_GET['id']);
                                    $select_comments = mysqli_query($connection, $query);

                                    while($rows = mysqli_fetch_assoc($select_comments)) {
                                        $comment_id = $rows['comment_id'];
                                        $comment_post_id = $rows['comment_post_id'];
                                        $comment_author = $rows['comment_author'];
                                        $comment_content = $rows['comment_content'];
                                        $comment_email = $rows['comment_email'];
                                        $comment_status = $rows['comment_status'];
                                        $comment_date = $rows['comment_date'];

                                        echo "<tr>";
                                ?>
                                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id; ?>'></td> 

                                <?php
                                            echo "<td>{$comment_id}</td>";
                                            echo "<td>{$comment_author}</td>";
                                            echo "<td>{$comment_content}</td>";

                                            /*$query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}' ";
                                            $select_categories_id = mysqli_query($connection, $query);

                                            // Code to select and display category according to the post_category_id.
                                            while($rows = mysqli_fetch_assoc($select_categories_id)) {
                                                $cat_id = $rows['cat_id'];
                                                $cat_title = $rows['cat_title'];
                                            // Display category
                                                echo "<td>{$cat_title}</td>";
                                            }*/

                                            echo "<td>{$comment_email}</td>";
                                            echo "<td>{$comment_status}</td>";

                                            $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";   
                                            $select_post_id_query = mysqli_query($connection, $query);

                                            while($rows = mysqli_fetch_assoc($select_post_id_query)) {
                                                $post_id = $rows['post_id'];
                                                $post_title = $rows['post_title'];

                                                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                                            }

                                            echo "<td>{$comment_date}</td>";
                                            echo "<td><a href='post_comments.php?approve={$comment_id}&id={$the_post_id}'>Approve</a></td>";
                                            echo "<td><a href='post_comments.php?unapprove={$comment_id}&id={$the_post_id}'>Unapprove</a></td>";
                                            echo "<td><a href='post_comments.php?delete={$comment_id}&id=" . $_GET['id'] . "'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </form>
                        <?php 
                            // Approve comments
                            if(isset($_GET['approve'])) {
                                $the_comment_id = $_GET['approve'];
                                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id} ";
                                $approve_comment_query = mysqli_query($connection, $query);
                                header("Location: post_comments.php?id={$the_post_id}");
                            }

                            // Unapprove comments
                            if(isset($_GET['unapprove'])) {
                                $the_comment_id = $_GET['unapprove'];
                                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id} ";
                                $unapprove_comment_query = mysqli_query($connection, $query);
                                header("Location: post_comments.php?id={$the_post_id}");
                            }

                            if(isset($_GET['delete'])) {
                                $the_comment_id = $_GET['delete'];
                                $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
                                $delete_query = mysqli_query($connection, $query);
                                header("Location: post_comments.php?id=" . $_GET['id']) . "";
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>        
        <!-- /#page-wrapper -->
    
<?php include "includes/admin_footer.php"; ?>






















