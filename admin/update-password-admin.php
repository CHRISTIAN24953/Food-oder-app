<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
//CHECK WHETHER THE SUBMIT BUTTON IS CLICKED OR NOT
if(isset($_POST['submit']))
{
    //1. GET THE DATA FROM FORM
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. CHECK WHETHER THE USER WITH CURRENT ID AND CURRENT PASSWORD EXISTS OR NOT
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //USER EXISTS AND PASSWORD CAN BE CHANGED
            //CHECK WHETHER NEW PASSWORD AND CONFIRM MATCH OR NOT
            if($new_password==$confirm_password)
            {
                //UPDATE THE PASSWORD
                $sql2 = "UPDATE tbl_admin SET
                password='$new_password' 
                WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                //CHECK WHETHER THE QUERY EXECUTED OR NOT
                if($res2==true)
                {
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    die();
                }
                else
                {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    die();
                }
            }
            else
            {
                $_SESSION['change-pwd'] = "<div class='error'>Password Did Not Match.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
                die();
            }
        }
        else
        {
            $_SESSION['change-pwd'] = "<div class='error'>Current Password is Incorrect.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
            die();
        }
    }
}

include("partials/footer.php"); 
?>