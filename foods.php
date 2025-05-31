<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                      
                      $sql2="SELECT * FROM tbl_food WHERE active='Yes'";
                      //execute query
                      $res2=mysqli_query($conn, $sql2);
                      //check whether query executed or not
                      
                      //count rows to check whether we have data in database or not
                         $count2=mysqli_num_rows($res2);//function to get all rows in db
                              
                              //check no of nows
                              if($count2>0)
                              {
                                      //we have data in database
                                      while($rows2=mysqli_fetch_assoc($res2))
                                      {
                                              //using while loop to get all data in db
                                              //and while loop will run as long as we have data in db

                                              //get individual data
                                              $id=$rows2['id'];
                                              $title=$rows2['title'];
                                              $price=$rows2['price'];
                                              $description=$rows2['description'];
                                              $image_name=$rows2['image_name'];

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
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                   
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
                

               
            
            </a>
                                                <?php
                                        

                                      }
                              }
                              else{
                                      //we do no have data in db
                                      echo "<div class='error'>Food Not Available</div>";
                              }
                      ?>
                      
            

                    
                
            </div>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>