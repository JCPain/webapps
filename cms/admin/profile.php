<?php include "includes/admin_header.php"; ?>

    <?php 
        # Display user profile according to session 'username'
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            
            $query = "SELECT * FROM users WHERE username = '{$username}' ";
            
            $select_user_profile_query = mysqli_query($connection, $query);
            
            while($rows = mysqli_fetch_array($select_user_profile_query)) {
                $user_id = $rows['user_id'];
                $username = $rows['username'];
                $user_password = $rows['user_password'];
                $user_firstname = $rows['user_firstname'];
                $user_lastname = $rows['user_lastname'];
                $user_email = $rows['user_email'];
                $user_image = $rows['user_image'];
                $user_role = $rows['user_role'];
            }
        }
    ?>
    
    <?php 
        # Update user profile
        if(isset($_POST['edit_user'])) {
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];

            /*$post_image = $_FILES['image']['name']; // image as name (key)
            $post_image_temp = $_FILES['image']['tmp_name'];*/

            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
    //        $post_date = date('d-m-y');
    //        $post_comment_count = 4;

    //        move_uploaded_file($post_image_temp, "../images/{$post_image}"); // Moves the file from temporary location to upload directory

            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_password = '{$user_password}' ";
            $query .= "WHERE username = '{$username}' ";


            $edit_user_query = mysqli_query($connection, $query);

            confirmQuery($edit_user_query);
        }
    ?>

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
                            Welcome to Admin
                            <small>Author</small>
                        </h1>


                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Firstname</label>
                                <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                            </div>

                            <div class="form-group">
                                <label for="author">Lastname</label>
                                <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                            </div>

                            <div class="form-group">
                                <label for="post_status">Username</label>
                                <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                            </div>

                            <div class="form-group">
                                <label for="post_status">Email</label>
                                <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                            </div>

                            <div class="form-group">
                                <label for="post_tags">Password</label>
                                <input autocomplete="off" type="password" class="form-control" name="user_password">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>        
        <!-- /#page-wrapper -->
    
<?php include "includes/admin_footer.php"; ?>