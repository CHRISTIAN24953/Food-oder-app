<?php 
include('../config/constants.php');

// 1. Get the ID of Admin to be deleted
if(isset($_GET['id']))
{
    $id = $_GET['id'];

    // 2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // 3. Execute the Query
    $res = mysqli_query($conn, $sql);

    // 4. Check whether the query executed successfully or not
    if($res == true)
    {
        // Query Executed Successfully and Admin Deleted
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        // Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // Failed to Delete Admin
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
else
{
    // Redirect to Manage Admin Page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
?>