<?php include_once('../config/constants.php'); ?>

<html>
<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
<style>
    body{
        background: linear-gradient(135deg, #32407e, #05000a);
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<body>

    <div class="login-card">  <!-- THIS LINE IS IMPORTANT -->
        <h1 class="text-center">Login</h1>
        <br>

        <?php 
            if(isset($_SESSION['login'])){ echo $_SESSION['login']; unset($_SESSION['login']); }
            if(isset($_SESSION['no-login-message'])){ echo $_SESSION['no-login-message']; unset($_SESSION['no-login-message']); }
        ?>

        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"> <br><br>
            
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"> <br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>

        <p class="text-center">Created By - <a href="#">Baffoe-Yeboah</a></p>
    </div>  <!-- CLOSE THE DIV -->

</body>

</html>
<?php
    // Check whether the Submit Button is Clicked or Not
    if(isset($_POST['submit']))
    {
        // 1. Get the Data from Login form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']);

        // 2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Execute the Query
        $res = mysqli_query($conn, $sql);

        // 4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // User Available and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; 
            header('location:'.SITEURL.'admin/');
            exit();
        }
        else
        {
            // User Not Available and Login Fail
            $_SESSION['login'] = "<div class='error'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'admin/login.php');
            exit();
        }
    }
?>

<?php
    // Your PHP login code here... same as before
?>