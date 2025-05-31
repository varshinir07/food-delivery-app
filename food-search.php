<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            $search=$_POST['search'];
                      ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
            
                      $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";
                      //execute query
                      $res=mysqli_query($conn, $sql);
                      //check whether query executed or not
                      
                      //count rows to check whether we have data in database or not
                         $count=mysqli_num_rows($res);//function to get all rows in db
                              
                              //check no of nows
                              if($count>0)
                              {
                                      //we have data in database
                                      while($rows=mysqli_fetch_assoc($res))
                                      {
                                              //using while loop to get all data in db
                                              //and while loop will run as long as we have data in db

                                              //get individual data
                                              $id=$rows['id'];
                                              $title=$rows['title'];
                                              $price=$rows['price'];
                                              $description=$rows['description'];
                                              $image_name=$rows['image_name'];

                                              //display values in our table
                                              ?>
        <div class="food-menu-box">
                <div class="food-menu-img">
                <?php
                    if($image_name==""){
                            echo "<div class='error'>Image not Available</div>";
                    }
                    else{
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">


                            <?php
                    }
                     ?>
                    
                </div>
                
                <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Rs.<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?> " class="btn btn-primary">Order Now</a>
                </div></div>
            

                    <?php
                }
            }
            else
            {
                //Food not available
                echo "<div class='error'>Food not available.</div>";
            }

            ?>





            <div class="clearfix"></div>

            

        </div>

        
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>