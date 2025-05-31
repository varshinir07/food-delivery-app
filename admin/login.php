<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>
            Login - Food Order System
        </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head> 
    <body>
        <div class = "login">
            <h1 class= "text-center">Login Page</h1>
            <br><br>
            <?php
            if(isset($_SESSION['login']))
            {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
            }
            ?><br><br>

            <!-- Login starts here -->
            <form action="" method="POST" class="text-center">
            Username:<br><br>
            <input type="text" name="username" placeholder="Enter Your Username"><br><br>

            Password:<br><br>
            <input type="password" name="password" placeholder="Enter Your Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary"> <br><br>  
        </form>

            <!-- Login ends here -->

            <p class= "text-center">Created By - Varsha</p>
        </div>
    </body>
</html>
<?php
   //Process the value from form and save it in database

   //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "Button Clicked";
        //get data from form
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        //SQL query to save data to database
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        //execute query
        $res=mysqli_query($conn, $sql);
        //count rows to check whether we have data in database or not
        $count=mysqli_num_rows($res);
        if($count==1)
            {
                //user available and login success
                $_SESSION['login']="<div class='success'>Login Successful</div>";
                $_SESSION['user']=$username;//to check whether the user is logged in or not and logout will unset it
                //redirect page to admin
                header("location:".SITEURL.'admin/'); 

            }
        else{
            $_SESSION['login']="<div class='error' text-center>Username or Password did not match</div>";
            //redirect page to admin
            header("location:".SITEURL.'admin/login.php');
             }
    }
?>