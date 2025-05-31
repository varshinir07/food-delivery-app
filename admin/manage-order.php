<?php include('partials/menu.php');?>

         <!-- Main Content Section Starts -->
         <div class="main-content">
         <div class="wrapper">
         <h1>Manage Order</h1>
         <br /> <br /> <br />
         <?php
         if(isset($_SESSION['update']))
         {
                 echo $_SESSION['update'];
                 unset($_SESSION['update']);
         }
         ?>
         <table class="tbl-full">
                <tr>
                        <th>S.No.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                </tr>
                <?php 
                      //query to get all category
                      $sql="SELECT * FROM tbl_order ORDER BY id DESC";
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
                                              $food=$rows['food'];
                                              $price=$rows['price'];
                                              $qty=$rows['qty'];
                                              $total=$rows['total'];
                                              $order_date=$rows['order_date'];
                                              $status=$rows['status'];
                                              $customer_name=$rows['customer_name'];
                                              $customer_contact=$rows['customer_contact'];
                                              $customer_email=$rows['customer_email'];
                                              $customer_address=$rows['customer_address'];
                                              ?>
                                              <tr>
                                                 <td><?php echo $sn++; ?></td>
                                                 <td><?php echo $food; ?></td>
                                                 <td><?php echo $price; ?></td>
                                                 <td></td>
                                                 <td><?php echo $qty; ?></td>
                                                 <td><?php echo $total; ?></td>
                                                 <td><?php echo $order_date; ?></td>
                                                 <td><?php echo $customer_name; ?></td>
                                                 <td><?php echo $customer_contact; ?></td>
                                                 <td><?php echo $customer_email; ?></td>
                                                 <td><?php echo $customer_address; ?></td>


                                                 
                                                 <td>
                                                     <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                                     
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
                               <td colspan="12"><div class="error">Order Unavailable</div></td>
                         </tr>
                        <?php
                        
                
                
                
                
                }
                        ?>
                
        </table>  
      

        </div>
             
        </div>  
         <!-- Main Content Section Ends -->


<?php include('partials/footer.php');?>