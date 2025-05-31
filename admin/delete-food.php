<?php
//include constants.php file here
include('../config/constants.php');
//echo "delete page";
//check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the value and delete
    //echo "get value and delete"
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //remove the physical image file is available
    if($image_name!="")
    {
        //image avail.so remove
        $path="../images/food/".$image_name;
        //remove page
        $remove=unlink($path);
        //if failed to remove image then add error msg and stop process
        if($remove==false){
            //set session msg
            $_SESSION['remove']="<div class='error'>Failed to Remove Food Image.</div>";
            //redirect to manage food page
            header("location:".SITEURL.'admin/manage-food.php');
            //stop process
            die();
        }
    }
    //delete data from db
    //create sql query to delete food
    $sql = "DELETE FROM tbl_food WHERE id=$id;";
    //execute sql query
    $res=mysqli_query($conn, $sql);
    //check whether query executed successfully or not
    if($res==true)
    {
     //query executed successfully and food deleted
     //echo "Food DELETED";
     //create session variable to display message
     $_SESSION['delete']="<div class='success'>Food Deleted Successfully</div>";
     //Redirect to Manage food Page
     header("location:".SITEURL.'admin/manage-food.php');
    }
 else{
     //failed to delete food
     //echo "FAILED TO DELETE FOOD";
     $_SESSION['delete']="<div class='error'>Failed to Delete Food. Try Again Later.</div>";
     //Redirect to Manage food Page
     header("location:".SITEURL.'admin/manage-food.php');
 }




}
else{
    
    //Redirect to Manage food Page
     header("location:".SITEURL.'admin/manage-food.php');
}
?>