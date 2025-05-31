<!<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                      
                      $sql="SELECT * FROM tbl_category WHERE active='Yes'";
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
                                              $image_name=$rows['image_name'];

                                              //display values in our table
                                              ?>
                                              <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                              
                                              
                <div class="box-3 float-container">
                    <?php
                    if($image_name==""){
                            echo "<div class='error'>Image not Available</div>";
                    }
                    else{
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">


                            <?php
                    }
                    ?>
                

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>
                                                <?php
                                        

                                      }
                              }
                              else{
                                      //we do no have data in db
                                      echo "<div class='error'>Category Not Found</div>";
                              }
                      ?>
        
        

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>