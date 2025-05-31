<?php include('partials/menu.php');?>
<div class="main-content">
         <div class="wrapper">
             <h1>Add Food</h1>
             <br>
             <?php
             if(isset($_SESSION['upload']))
             {
                     echo $_SESSION['upload'];
                     unset($_SESSION['upload']);
             }
             
            ?>
             <form action="" method="POST" enctype="multipart/form-data">
                 <table class="tbl-30">
                     <tr>
                         <td>Title: </td>
                         <td><input type="text" name="title" placeholder="Food Title"></td>
                    </tr>
                    <tr>
                         <td>Description: </td>
                         <td><textarea name="description" cols="30" rows="5" placeholder="Food Description"></textarea></td>
                    </tr>
                    <tr>
                         <td>Price: </td>
                         <td><input type="number" name="price"></td>
                    </tr>
                    <tr>
                         <td>Select Image: </td>
                         <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                         <td>Category: </td>
                         <td><select name="category">
                             <?php
                             //display category from db
                             //create sql to get all active categories from db
                             $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                             $res=mysqli_query($conn,$sql);
                             $count=mysqli_num_rows($res);
                             if($count>0)
                             {
                                 //get the details
                                      
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                    <?php


                                }
                                

                            } 
                            else
                            {
                                ?>
                                <option value="0">No Category Found</option>

                                <?php

                            }
                            ?>
                            </select>
                             
                         </td>
                    </tr>
                    <tr>
                         <td>Featured: </td>
                         <td><input type="radio" name="featured" value="Yes">Yes
                         <input type="radio" name="featured" value="No">No</td>
                    </tr>
                    <tr>
                         <td>Active: </td>
                         <td><input type="radio" name="active" value="Yes">Yes
                         <input type="radio" name="active" value="No">No</td>
                    </tr>
                    <tr>
                         <td colspan="2">                         
                             <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    </tr>

                </table> 
             </form>

         </div>
</div>
             <!--add food form ends-->
             <?php include('partials/footer.php');?>
             <?php
   //Process the value from form and save it in database

   //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "Button Clicked";
        //get data from form
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $category=$_POST['category'];
        if(isset($_POST['featured'])){
            $featured=$_POST['featured'];

        }
        else{
            //set default value
            $featured="No";
        }
        if(isset($_POST['active'])){
            $active=$_POST['active'];

        }
        else{
            //set default value
            $active="No";
        }
        if(isset($_FILES['image']['name'])){
            //upload image
            //to upload image,we need img name,source path and destination path
            $image_name=$_FILES['image']['name'];
            //upload image only if image is selected
            if($image_name!=""){
                     

            //auto rename our image
            //get extension of image(.jpg,png,jpeg,gif etc)eg=splfood.jpg
            $ext=end(explode('.',$image_name));

            //rename img
            $image_name="Food_Name_".rand(000,999).'.'.$ext;//eg=Food_Category_random no .jpg

            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/food/".$image_name;
            //upload image
            $upload=move_uploaded_file($source_path,$destination_path);
            //check whether the image uploaded or not
            //and if image not uploaded then will stop process and redirect with error msg
            if($upload==false){
                //set message
                $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
             //redirect page to add category
             header("location:".SITEURL.'admin/add-food.php');
            //stop process
            die();
            }}



        }
        else{
            //dont upload img and set image_value as blank
            $image_name="";
        }
        $sql2="INSERT INTO tbl_food SET
        title='$title',
        description='$description',
        price=$price,
        image_name='$image_name',
        category_id=$category,
        featured='$featured',
        active='$active'";
        //executing query and saving data into db
        $res2=mysqli_query($conn, $sql2); 
        //check whether the (query is executed) data is inserted or not and display appropriate message
        if($res2==TRUE)
         {
             //query executed and category added
             //create a session variable to display a message
             $_SESSION['add']="<div class='success'>Food Added Successfully</div>";
             //redirect page to manage category
             header("location:".SITEURL.'admin/manage-food.php'); 
             
         }
         else{
             //failed to add category
             //create a session variable to display a message
             $_SESSION['add']="<div class='error'>Failed to Add Food</div>";
             //redirect page to add category
             header("location:".SITEURL.'admin/add-food.php');
             

         }
       
    }
?>