<?php include('partials/menu.php');?>
<div class="main-content">
         <div class="wrapper">
             <h1>Add Category</h1>
             
             <?php
             if(isset($_SESSION['add']))
                 {
                 echo $_SESSION['add'];
                 unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                    }
         ?>
         <br /><br />
             <!--add category form starts-->
             <form action="" method="POST" enctype="multipart/form-data">
                 <table class="tbl-30">
                     <tr>
                         <td>Title: </td>
                         <td><input type="text" name="title" placeholder="Category Title"></td>
                    </tr>
                    <tr>
                         <td>Select Image: </td>
                         <td><input type="file" name="image"></td>
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
                             <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>

                </table> 
             </form>

         </div>
</div>
             <!--add category form ends-->
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
        //for radio input,we need to check whether the button is clicked or not
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
        //check whether the img is selected or not and set the value for image
        //print_r($_FILES['image']);
        //die();//break the code
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
            $image_name="Food_Category_".rand(000,999).'.'.$ext;//eg=Food_Category_random no .jpg

            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$image_name;
            //upload image
            $upload=move_uploaded_file($source_path,$destination_path);
            //check whether the image uploaded or not
            //and if image not uploaded then will stop process and redirect with error msg
            if($upload==false){
                //set message
                $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
             //redirect page to add category
             header("location:".SITEURL.'admin/add-category.php');
            //stop process
            die();
            }}



        }
        else{
            //dont upload img and set image_value as blank
            $image_name="";
        }
        //SQL query to insert category to database
        $sql="INSERT INTO tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'";
        //executing query and saving data into db
        $res=mysqli_query($conn, $sql); 
        //check whether the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE)
         {
             //query executed and category added
             //create a session variable to display a message
             $_SESSION['add']="<div class='success'>Category Added Successfully</div>";
             //redirect page to manage category
             header("location:".SITEURL.'admin/manage-category.php'); 
             
         }
         else{
             //failed to add category
             //create a session variable to display a message
             $_SESSION['add']="<div class='error'>Failed to Add Category</div>";
             //redirect page to add category
             header("location:".SITEURL.'admin/add-category.php');
             

         }
       
    }
?>