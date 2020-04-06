<?php 
    if(isset($_POST['checkBoxArray'])) {
        foreach($_POST['checkBoxArray'] as $postValueId) {
            $bulkOptions = $_POST['bulk_options'];
            
            switch($bulkOptions) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$postValueId} ";
                    $update_to_published_status = mysqli_query($connection, $query);
                    
                    confirmQuery($update_to_published_status); 
                break;
                
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$postValueId} ";
                    $update_to_draft_status = mysqli_query($connection, $query);
                    
                    confirmQuery($update_to_draft_status); 
                break;
                
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                    $update_to_delete_status = mysqli_query($connection, $query);
                    
                    confirmQuery($update_to_delete_status); 
                break;
                    
                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                    $select_post_query = mysqli_query($connection, $query);
                    
                    confirmQuery($select_post_query);
                    
                    while($row = mysqli_fetch_assoc($select_post_query)) {
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                    }
                    
                    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                    $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', NOW(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
                    
                    $copy_query = mysqli_query($connection, $query);
                    
                    confirmQuery($copy_query);
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
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>

        </div>
        <div class="col-xs-6 space">
            <input type="submit" class='btn btn-success' value='Apply'>
            <a class='btn btn-primary' href="posts.php?source=add_post">Add New</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><input id='selectAllBoxes' type="checkbox"></th>
                    <th>Id</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th colspan='3'>Action</th>
                    <th>Views</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT * FROM posts ORDER BY post_id DESC ";
                    $select_posts = mysqli_query($connection, $query);

                    while($rows = mysqli_fetch_assoc($select_posts)) {
                        $post_id = $rows['post_id'];
                        $post_author = $rows['post_author'];
                        $post_user = $rows['post_user'];
                        $post_title = $rows['post_title'];
                        $post_category_id = $rows['post_category_id'];
                        $post_status = $rows['post_status'];
                        $post_image = $rows['post_image'];
                        $post_tags = $rows['post_tags'];
                        $post_comment_count = $rows['post_comment_count'];
                        $post_date = $rows['post_date'];
                        $post_views_count = $rows['post_views_count'];

                        
                        echo "<tr>";    
                ?>
                 
                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>          
                           
                <?php
                            echo "<td>{$post_id}</td>";
                         
                            if(!empty($post_author)) {
                                echo "<td>{$post_author}</td>";
                            
                            } elseif(!empty($post_user)) {
                                echo "<td>{$post_user}</td>";
                            }
                        
                        
                            echo "<td>{$post_title}</td>";

                            $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}' ";
                            $select_categories_id = mysqli_query($connection, $query);

                            // Code to select and display category according to the post_category_id.
                            while($rows = mysqli_fetch_assoc($select_categories_id)) {
                                $cat_id = $rows['cat_id'];
                                $cat_title = $rows['cat_title'];
                            // Display category
                                echo "<td>{$cat_title}</td>";
                            }

                            echo "<td>{$post_status}</td>";
                            echo "<td><img width='100' src='../images/{$post_image}' alt='image' /></td>";
                            echo "<td>{$post_tags}</td>";
                        
                            $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                            $send_comment_query = mysqli_query($connection, $query);
                            $row = mysqli_fetch_array($send_comment_query);
                            $comment_id = $row['comment_id'];
                            $count_comments = mysqli_num_rows($send_comment_query);
                        
                            echo "<td><a href='post_comments.php?id={$post_id}'>{$count_comments}</td>";
                            echo "<td>{$post_date}</td>";
                            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                            echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </form>
        <?php 
            if(isset($_GET['delete'])) {
                $the_post_id = $_GET['delete'];
                $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
                $delete_query = mysqli_query($connection, $query);
                header("Location: posts.php");
            }
            
            # RESET VIEWS COUNT
            if(isset($_GET['reset'])) {
                $the_post_id = escape($_GET['reset']);
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = " . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
                $reset_query = mysqli_query($connection, $query);
                header("Location: posts.php");
            }
        ?>
</div>






















