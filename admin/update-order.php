<?php include('partials/menu.php');?>
<div class="main-content">
         <div class="wrapper">
             <h1>Update Order</h1>
             <br />
             <?php 
             if(isset($_GET['id'])){
                      //get the id of selected order
                      $id=$_GET['id'];
                      //query to get all order
                      $sql="SELECT * FROM tbl_order WHERE id=$id";
                      //execute query
                      $res=mysqli_query($conn, $sql);
                      //check whether query executed or not
                      if($res==TRUE)
                      {
                              //count rows to check whether we have data in database or not
                              $count=mysqli_num_rows($res);//function to get all rows in db
                              //check whether we have order data or not
                              if($count==1)
                              {
                                      //get the details
                                      //echo "Order Available";
                                      $rows=mysqli_fetch_assoc($res);
                                      $food=$rows['food'];
                                     $price=$rows['price'];
                                     $qty=$rows['qty'];
                                     $status=$rows['status'];
                                     $customer_name=$rows['customer_name'];
                                     $customer_contact=$rows['customer_contact'];
                                     $customer_email=$rows['customer_email'];
                                     $customer_address=$rows['customer_address'];
                              }
                              else
                              {
                                  //redirect to manage order page
                                  header("location:".SITEURL.'admin/manage-order.php');
                              }
                      }
                    }
                    else{
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }
                 ?>
             <form action="" method="POST">
                 <table class="tbl-30">
                     <tr>
                         <td>Food Name: </td>
                         <td><b><?php echo $food; ?></b></td>
                    <tr>
                         <td>Price: </td>
                         <td><b>Rs.<?php echo $price; ?></b></td>
                         
                    </tr>
                         
                    </tr>
                    <tr>
                         <td>Qty: </td>
                         <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                    </tr>
                    <tr>
                         <td>Status: </td>
                         <td>
                             <select name="status">
                         <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                         <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                         <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                         <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select></td>
                    </tr>
                    <tr>
                         <td>Customer Name: </td>
                         <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                    </tr>
                    <tr>
                         <td>Contact: </td>
                         <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                    </tr>
                    <tr>
                         <td>Email: </td>
                         <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                    </tr>
                    <tr>
                         <td>Address: </td>
                         <td>
                         <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2">
                             <input type="hidden" name="id" value="<?php echo $id; ?>">
                             <input type="hidden" name="price" value="<?php echo $price; ?>">
                             <input type="submit" name="submit" value="Update Order" class="btn-secondary">
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
        $food=$_POST['food'];
        $price=$_POST['price'];
        $qty=$_POST['qty'];
        $total=$price*$qty;
        
        $status=$_POST['status'];
        $customer_name=$_POST['customer_name'];
        $customer_contact=$_POST['customer_contact'];
        $customer_email=$_POST['customer_email'];
        $customer_address=$_POST['customer_address'];
        //SQL query to update order
        $sql2="UPDATE tbl_order SET
        
        qty='$qty',
        total=$total,
        
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address'
        WHERE id=$id";
        //execute query
         $res2=mysqli_query($conn, $sql2); 
         //check whether the (query is executed)  or not 
         if($res2==TRUE)
          {
              //equery executed and order updated
              //create a session variable to display a message
              $_SESSION['update']="<div class='success'>Order Updated Successfully</div>";
              //redirect page to manage order
              header("location:".SITEURL.'admin/manage-order.php'); 
              
          }
          else{
              //Failed to update order
              //create a session variable to display a message
              $_SESSION['update']="<div class='error'>Failed to Update Order</div>";
              //redirect page to manage order
              header("location:".SITEURL.'admin/manage-order.php');
              
 
          }
        
     }
 ?>
<?php include('partials/footer.php');?>