<?php 
    if(isset($_GET['edit_user'])) {
        $the_user_id = escape($_GET['edit_user']);
        $query = "SELECT * FROM users WHERE user_id = {$the_user_id} ";
        $select_users_query = mysqli_query($connection, $query);

        while($rows = mysqli_fetch_assoc($select_users_query)) {
            $user_id = $rows['user_id'];
            $username = $rows['username'];
            $user_password = $rows['user_password'];
            $user_firstname = $rows['user_firstname'];
            $user_lastname = $rows['user_lastname'];
            $user_email = $rows['user_email'];
            $user_image = $rows['user_image'];
            $user_role = $rows['user_role'];
        }
        
        # UPDATE FUNCTIONALITY
        if(isset($_POST['edit_user'])) {
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];

            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password']; // NEW PASSWORD IF NOT EMPTY
    //        $post_date = date('d-m-y');

            # GET CURRENT DB PASSWORD
            if(!empty($user_password)) {
                $query_password = "SELECT user_password FROM users WHERE user_id = {$the_user_id} ";
                $get_user_query = mysqli_query($connection, $query_password);
                confirmQuery($get_user_query);
                $row = mysqli_fetch_array($get_user_query);
                $db_user_password = $row['user_password'];

                # COMPARE POST PASSWORD AND DB PASSWORD
                # IF DOES NOT MATCH, GET POSTED PASSWORD AND ENCRYPT IT
                if($db_user_password != $user_password) {
                    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
                }

                # UPDATE USER
                $query = "UPDATE users SET ";
                $query .= "user_firstname = '{$user_firstname}', ";
                $query .= "user_lastname = '{$user_lastname}', ";
                $query .= "user_role = '{$user_role}', ";
                $query .= "username = '{$username}', ";
                $query .= "user_email = '{$user_email}', ";
                $query .= "user_password = '{$hashed_password}' ";
                $query .= "WHERE user_id = {$the_user_id} ";

                $edit_user_query = mysqli_query($connection, $query);

                confirmQuery($edit_user_query);

                echo "User Updated" . " <a href='users.php'>View Users</a>";
            } else { // if password not empty check end
                echo "Password field cannot be empty";
            }
        } // Post request to update user end
    } else {
        header("Location: index.php");
    }
?>

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
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            
            <?php
                if($user_role == 'admin') {
                    echo "<option value='subscriber'>subscriber</option>";
                } else {
                    echo "<option value='admin'>admin</option>";
                }
            ?>
        
        </select>
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
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>
</form>