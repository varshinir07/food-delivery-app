<?php
//include constants.php file here
include('../config/constants.php');
 //get the id of admin to be deleted
 $id=$_GET['id'];

 //create sql query to delete admin
 $sql = "DELETE FROM tbl_admin WHERE id=$id;";
 //execute sql query
 $res=mysqli_query($conn, $sql);
 //check whether query executed successfully or not
 if($res==true)
 {
     //query executed successfully and admin deleted
     //echo "ADMIN DELETED";
     //create session variable to display message
     $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
     //Redirect to Manage Admin Page
     header("location:".SITEURL.'admin/manage-admin.php');
 }
 else{
     //failed to delete admin
     //echo "FAILED TO DELETE ADMIN";
     $_SESSION['delete']="<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
     //Redirect to Manage Admin Page
     header("location:".SITEURL.'admin/manage-admin.php');
 }

 //redirect to manage admin page with message(success/error)

 ?>