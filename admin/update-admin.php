<?php include("partials/menu.php"); ?>

<?php 
// 1. CHECK IF SUBMIT BUTTON IS CLICKED FIRST
if(isset($_POST['submit']))
{
    // 2. GET ALL VALUES FROM FORM
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    // 3. CREATE SQL QUERY TO UPDATE ADMIN
    $sql = "UPDATE tbl_admin SET 
            full_name = '$full_name',
            username = '$username' 
            WHERE id='$id'
            ";

    // 4. EXECUTE THE QUERY
    $res = mysqli_query($conn, $sql);

    // 5. CHECK IF QUERY EXECUTED
    if($res==true)
    {
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
        die(); // important to stop code here
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
        die();
    }
}
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
        // 6. GET THE ID OF SELECTED ADMIN
        $id=$_GET['id'];
        
        // 7. CREATE SQL QUERY TO GET DETAILS
        $sql="SELECT * FROM tbl_admin WHERE id=$id";
        
        // 8. EXECUTE THE QUERY
        $res=mysqli_query($conn, $sql);

        // 9. GET THE VALUE
        if($res==true)
        {
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                $row=mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php"); ?>