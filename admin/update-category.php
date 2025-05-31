<?php include('partials/menu.php');?>
<div class="main-content">
         <div class="wrapper">
             <h1>Update Category</h1>
             <br>
             <?php
             //check whether id is set or not
             if(isset($_GET['id'])){
                 //get the id of selected category
                 $id=$_GET['id'];
                 //query to get all category
                 $sql="SELECT * FROM tbl_category WHERE id=$id";
                 //execute query
                 $res=mysqli_query($conn, $sql);
                 //count rows to check whether we have data in database or not
                 $count=mysqli_num_rows($res);//function to get all rows in db
                 //check whether we have admin data or not
                 if($count==1)
                 {
                     //get the details
                     //echo "Admin Available";
                     $row=mysqli_fetch_assoc($res);
                     $title=$row['title'];
                     $current_image=$row['image_name'];
                     $featured=$row['featured'];
                     $active=$row['active'];

                }
                else{
                    $_SESSION['no-category-found']="<div class='error'>Category Not Found</div>";
                    //redirect page to manage category
                    header("location:".SITEURL.'admin/manage-category.php');
             
                }}
                else
                {
                    //redirect to manage category page
                    header("location:".SITEURL.'admin/manage-category.php');
                    }
                 
            ?>
            
             <form action="" method="POST" enctype="multipart/form-data">                         
                 <table class="tbl-30">
                     <tr>
                         <td>Title: </td>
                         <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>
                    <tr>
                         <td>Current Image: </td>
                         <td>
                         <?php 
                                                         //check whether current_image is available or not
                                                         if($current_image!=""){
                                                                 //display image
                                                                 ?>
                                                                 <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?> "width="100px">
                                                                 
                                                                 <?php

                                                         }
                                                         else{
                                                                 //display message
                                                                 echo "<div class='error'>Image Not Added</div>";
                                                         }
                                                          ?>
                        </td>
                    </tr>
                    <tr>
                         <td>New Image: </td>
                         <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                    <td>Featured: </td>
                         <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No</td>
                    </tr>
                    <tr>
                         <td>Active: </td>
                         <td><input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                         <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No</td>
                    </tr>
                    <tr>
                         <td>
                         <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                         <input type="hidden" name="id" value="<?php echo $id; ?>">
                                               
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                    </table> 
             </form>
             <?php
   //Process the value from form and save it in database

   //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "Button Clicked";
        //get data from form
        $id=$_POST['id'];
        $title=$_POST['title'];
        $current_image=$_POST['current_image'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];
        //updating new img if selected
        //check whether image is selected or not
        if(isset($_FILES['image']['name']))
        {
            //upload image
            //to upload image,we need img name,source path and destination path
            $image_name=$_FILES['image']['name'];
            //upload image only if image is selected
            if($image_name!="")
            {
                //auto rename our image
                //get extension of image(.jpg,png,jpeg,gif etc)eg=splfood.jpg
                $ext=end(explode('.',$image_name));

                //rename img
                $image_name="Food_Category_".rand(000,999).'.'.$ext;//eg=Food_Category_random no .jpg

                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/category/".$image_name;
                //upload image
                $upload=move_uploaded_file($source_path,$destination_path);
                //check whether the image uploaded or not
                //and if image not uploaded then will stop process and redirect with error msg
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
                    //redirect page to add category
                    header("location:".SITEURL.'admin/manage-category.php');
                    //stop process
                    die();
                }
                $remove_path="../images/category/".$current_image;
                $remove=unlink($remove_path);
                //check whether image removed or not
                //if failed,display msg and stop
                if($remove==false){
                    //set message
                    $_SESSION['failed-remove']="<div class='error'>Failed to Remove Current Image</div>";
                    //redirect page to add category
                    header("location:".SITEURL.'admin/manage-category.php');
                    die();
                }
            }
            else
            {
                $image_name=$current_image;
            }
        }
        else
        {
            $image_name=$current_image;
        }
        
        //SQL query 

        //update db
        $sql2="UPDATE tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        WHERE id='$id'";
        //execute query
         $res=mysqli_query($conn, $sql2); 

        //redirect
        //execute query
        $res=mysqli_query($conn, $sql); 
        //check whether the (query is executed)  or not 
        if($res==TRUE)
         {
             //equery executed and ategory updated
             //create a session variable to display a message
             $_SESSION['update']="<div class='success'>Category Updated Successfully</div>";
             //redirect page to manage ategory
             header("location:".SITEURL.'admin/manage-category.php'); 
             
         }
         else{
             //Failed to update ategory
             //create a session variable to display a message
             $_SESSION['update']="<div class='error'>Failed to Update Category</div>";
             //redirect page to manage ategory
             header("location:".SITEURL.'admin/manage-category.php');
             

         }
       
    }
?>

        </div>
 </div>
 <?php include('partials/footer.php');?>