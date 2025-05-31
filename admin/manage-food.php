<?php include('partials/menu.php');?>

         <!-- Main Content Section Starts -->
         <div class="main-content">
         <div class="wrapper">
         <h1>Manage Food</h1>
         <br />
         <?php
         if(isset($_SESSION['add']))
                 {
                 echo $_SESSION['add'];
                 unset($_SESSION['add']);
                    }
        if(isset($_SESSION['delete']))
                    {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                    }
        if(isset($_SESSION['remove']))
                    {
                            echo $_SESSION['remove'];
                            unset($_SESSION['remove']);
                    }
                    if(isset($_SESSION['update']))
                    {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['failed-remove']))
         {
                 echo $_SESSION['failed-remove'];
                 unset($_SESSION['failed-remove']);
         }
                    
                    ?><br><br>
         <!--Button to add admin-->
         <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
         <br /> <br /> <br />
         <table class="tbl-full">
         <tr>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                </tr>
                <?php 
                      //query to get all category
                      $sql="SELECT * FROM tbl_food";
                      //execute query
                      $res=mysqli_query($conn, $sql);
                      //count rows
                      $count=mysqli_num_rows($res);
                      $sn=1;//create a variable and assign a value
                      if($count>0)
                      {
                              //we have data in database
                              //get data and display
                              while($rows=mysqli_fetch_assoc($res))
                                      {
                                              //using while loop to get all data in db
                                              //and while loop will run as long as we have data in db

                                              //get individual data
                                              $id=$rows['id'];
                                              $title=$rows['title'];
                                              $price=$rows['price'];
                                              $image_name=$rows['image_name']; 
                                              $featured=$rows['featured']; 
                                              $active=$rows['active'];
                                              ?>
                                              <tr>
                                                 <td><?php echo $sn++; ?></td>
                                                 <td><?php echo $title; ?></td>
                                                 <td><?php echo $price; ?></td>

                                                 <td>
                                                         <?php 
                                                         //check whether image name is available or not
                                                         if($image_name!=""){
                                                                 //display image
                                                                 ?>
                                                                 <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?> "width="100px">
                                                                 
                                                                 <?php

                                                         }
                                                         else{
                                                                 //display message
                                                                 echo "<div class='error'>Image Not Added</div>";
                                                         }
                                                          ?>
                                                </td>

                                                 <td><?php echo $featured; ?></td>
                                                 <td><?php echo $active; ?></td>
                                                 <td>
                                                     <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                                     <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                                </td>
                                                </tr>
                                                <?php
                                        

                                      }
                      }
                      else{
                              //we do not have data in database
                              //we will display the message inside the table
                        ?>
                        <tr>
                                <td colspan="7"><div class="error">No Food Added</div></td>
                         </tr>
                        <?php
                        
                
                
                
                
                }
                        ?>
                              
                 
                
                
        </table>  
      

        </div>
             
        </div>  
         <!-- Main Content Section Ends -->
<?php include('partials/footer.php'); ?>