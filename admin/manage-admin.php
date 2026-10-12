        <?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        
        <br /><br />

                    <?php
                // Show Add Message
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                // Show Delete Message - PUT IT HERE
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                // Show Update Message
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
 
            ?>

            <br><br>

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-admin.php" class="btn-primary">Add Admin</a>
        
        <br /><br /><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php
            //Query to Get All Admin
            $sql = "SELECT * FROM tbl_admin";
            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check whether the Query is Executed or not
            if($res==TRUE)
            {
                // Count Rows
                $count = mysqli_num_rows($res);

                $sn = 1; //Create Serial Number

                //Check if we have data
                if($count>0)
                {
                    //We Have Data in Database
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Get Individual Data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Display the Values in Table
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password-admin.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    //We Do Not have Data
                    ?>
                    <tr>
                        <td colspan="4" class="error">No Admin Added Yet.</td>
                    </tr>
                    <?php
                }
            }
            ?>

        </table>
    </div>
</div>

<?php include("partials/footer.php"); ?>