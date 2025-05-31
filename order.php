<?php include('partials-front/menu.php'); ?>

<?php
if(isset($_GET['food_id'])){
    $food_id=$_GET['food_id'];
    $sql="SELECT * FROM tbl_food WHERE id=$food_id";
    //execute query
    $res=mysqli_query($conn, $sql);
    //check whether query executed or not
    
    //count rows to check whether we have data in database or not
       $count=mysqli_num_rows($res);//function to get all rows in db
            
            //check no of nows
            if($count==1)
            {
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
            }
            else{
                header('location:'.SITEURL);
            }

}
else{
    header('location:'.SITEURL);
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                    <?php
                    if($image_name==""){
                            echo "<div class='error'>Image not Available</div>";
                    }
                    else{
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"alt="Chicke Hawain Pizza" class="img-responsive img-curve">


                            <?php
                    }
                    ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">Rs.<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Varshini" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. varshu@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
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
        $order_date=date("Y-m-d h:i:sa");
        $status="Ordered";
        $customer_name=$_POST['full-name'];
        $customer_contact=$_POST['contact'];
        $customer_email=$_POST['email'];
        $customer_address=$_POST['address'];
        
        //SQL query 

        //update db
        $sql2="INSERT INTO tbl_order SET
        food='$food',
        price=$price,
        qty='$qty',
        total=$total,
        order_date='$order_date',
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address'
        ";

        //execute query
         $res2=mysqli_query($conn, $sql2); 

        
        
        //check whether the (query is executed)  or not 
        if($res2==TRUE)
         {
             //equery executed and ategory updated
             //create a session variable to display a message
             $_SESSION['order']="<div class='success text-center'>Food Ordered Successfully</div>";
             //redirect page to manage ategory
             header("location:".SITEURL); 
             
         }
         else{
             //Failed to update ategory
             //create a session variable to display a message
             $_SESSION['order']="<div class='error text-center'>Failed to Order Food</div>";
             //redirect page to manage ategory
             header("location:".SITEURL);
             

         }
       
    }
?>

    <?php include('partials-front/footer.php'); ?>