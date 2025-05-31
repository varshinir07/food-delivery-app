<?php include('partials/menu.php');?>
<div class="main-content">
         <div class="wrapper">
             <h1>Change Password</h1>
             <br /><br />
             <?php
             if(isset($_GET['id']))
             {
                 $id=$_GET['id'];
             }
             ?>
             <form action="" method="POST">
                 <table class="tbl-30">
                 <tr>
                         <td> Current Password: </td>
                         <td><input type="password" name="current_password" placeholder="Enter Your Current Password"></td>
                </tr>
                    <tr>
                         <td> New Password: </td>
                         <td><input type="password" name="new_password" placeholder="Enter Your New Password"></td>
                    </tr>
                    <tr>
                         <td>Confirm Password: </td>
                         <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>
                    <tr>
                         <td colspan="2">  
                            <input type="hidden" name="id" value="<?php echo $id; ?>">                       
                             <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                    </table> 
             </form>

         </div>
         
</div>
<?php
    //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "Button Clicked";
        //get data from form
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);
        //check whether user with current id and current password exists or not
        $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        //execute query
        $res=mysqli_query($conn, $sql);
        if($res==TRUE)
        {                                 
            //check whether we have data in database or not
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                //user exists and password cand be changed
                //echo "User Found";
                if($new_password==$confirm_password)
                {
                    //update password
                    //echo "pwd match";
                    $sql2="UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id";
                    //execute query
                    $res2=mysqli_query($conn, $sql2);
                    //check whether query executed or not
                    if($res2==true){
                        $_SESSION['change-pwd']="<div class='success'>Password Changed Successfully</div>";
                        //redirect page to manage admin
                        header("location:".SITEURL.'admin/manage-admin.php'); 

                    }
                    else{
                        //display error message
                        $_SESSION['change-pwd']="<div class='error'>Password Did Not Change.</div>";
                        //redirect page to manage admin
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }

                }
                else{
                    $_SESSION['pwd-not-match']="<div class='error'>Password Did Not Match</div>";
                    //redirect page to manage admin
                    header("location:".SITEURL.'admin/manage-admin.php');
                }   
            }
            else{
                //user does not exist set message and redirect
                $_SESSION['user-not-found']="<div class='error'>User Not Found</div>";
                //redirect page to manage admin
                header("location:".SITEURL.'admin/manage-admin.php'); 
                }
        }
    }
?>




<?php include('partials/footer.php');?>