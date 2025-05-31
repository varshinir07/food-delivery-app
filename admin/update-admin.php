<?php include('partials/menu.php');?>
<div class="main-content">
         <div class="wrapper">
             <h1>Update Admin</h1>
             <br />
             <?php 
                      //get the id of selected admin
                      $id=$_GET['id'];
                      //query to get all admin
                      $sql="SELECT * FROM tbl_admin WHERE id=$id";
                      //execute query
                      $res=mysqli_query($conn, $sql);
                      //check whether query executed or not
                      if($res==TRUE)
                      {
                              //count rows to check whether we have data in database or not
                              $count=mysqli_num_rows($res);//function to get all rows in db
                              //check whether we have admin data or not
                              if($count==1)
                              {
                                      //get the details
                                      //echo "Admin Available";
                                      $row=mysqli_fetch_assoc($res);
                                      $full_name=$row['full_name'];
                                      $username=$row['username'];
                              }
                              else
                              {
                                  //redirect to manage admin page
                                  header("location:".SITEURL.'admin/manage-admin.php');
                              }
                      }
                 ?>
             <form action="" method="POST">
                 <table class="tbl-30">
                     <tr>
                         <td>Full Name: </td>
                         <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                    </tr>
                    <tr>
                         <td>Username: </td>
                         <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                    </tr>
                    </tr>
                    <tr>
                         <td colspan="2">
                             <input type="hidden" name="id" value="<?php echo $id; ?>">
                             <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                    </table> 
             </form>

        </div>
 </div>
 <?php
   //Process the value from form and save it in database

   //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "Button Clicked";
        //get data from form
        $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        //SQL query to update admin
        $sql="UPDATE tbl_admin SET
        full_name='$full_name',
        username='$username'
        WHERE id='$id'";
        //execute query
         $res=mysqli_query($conn, $sql); 
         //check whether the (query is executed)  or not 
         if($res==TRUE)
          {
              //equery executed and admin updated
              //create a session variable to display a message
              $_SESSION['update']="<div class='success'>Admin Updated Successfully</div>";
              //redirect page to manage admin
              header("location:".SITEURL.'admin/manage-admin.php'); 
              
          }
          else{
              //Failed to update admin
              //create a session variable to display a message
              $_SESSION['update']="<div class='error'>Failed to Update Admin</div>";
              //redirect page to manage admin
              header("location:".SITEURL.'admin/manage-admin.php');
              
 
          }
        
     }
 ?>
<?php include('partials/footer.php');?>