<?php
//include comstants.php
 include('../config/constants.php');
//destroy session
session_destroy();//unset $_session['user]

//redirect to login page
header("location:".SITEURL.'admin/login.php');
?>