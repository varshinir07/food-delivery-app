<?php
//authorization or access control
//check whether the user is logged in or not
if(!isset($_SESSION['user']))//uf user session is not set
         {//user not logged in
            //redirect to login page
            $_SESSION['no-login-message']="<div class='error' text-center>Please Login To Access Admin Panel</div>";
            //redirect page to admin
            header("location:".SITEURL.'admin/login.php');
         }
?>