<!--This is the content of our Testimonial Section-->
<div class="container">
    <div class="heading-wrapper">
        <h2 class="heading">Testimonials</h2>
        <!--
        <p>Our Health Therapist/Healing Coach is a knowledgeable and experienced professional with a deep understanding of how the human body works, and how to help the body heal from different diseases.</p> -->
        <p>Here are testimonials from some of our Patients.</p>
    </div>
    
    <div class="testimonial-wrapper">
        <div class="arrow-btn arrow-left btn-disabled">
            <i class="fa fa-arrow-left"></i>
        </div>

        <div class="testimonial-container slider">

            <?php
            //  Connect to the database
            include "database-connect.php";

            //  Let's select all the rows in the uat_testimonials table
            $sql = "SELECT * FROM uat_testimonials LIMIT 9";
            $testimonials = mysqli_query($conn, $sql);

            //  Using this while loop, display all the testimonials from each row, respectively
            while ($testimonial = mysqli_fetch_assoc($testimonials)) { ?>
                
                <div class="card">
                    <div class="column">
                        <div class="row">
                            <div class="card-header">
                                <div class="image">
                                    <img src="<?php echo $testimonial['avatar'] ?>" alt="Testifier">
                                </div>
                                <div class="caption">
                                    <h3><?php echo $testimonial['name'] ?></h3>
                                    <p><i class="fa fa-location-dot" aria-hidden="true"></i><?php echo $testimonial['location'] ?></p>
                                </div>
                            </div>                                    
                            <div class="card-body">
                                <p><?php echo $testimonial['testimony_summary'] ?></p>
                            </div>
                        </div>
                        <div class="row card-footer">
                            <?php
                                //  To place the testimonial tags in separate <span> elements, 
                                //  let's split them from the coma delimiter and store them in an array                            
                                $illness_tags = explode(",", $testimonial['illness_tags']);

                                //  After that, we use this foreach loop to display each of the tags in the array
                                foreach ($illness_tags as $tag) {
                                    echo '<span class="tag">' . trim($tag) . '</span>';
                                }
                            ?>                            
                        </div>
                    </div>
                </div>
                <?php
            }

            mysqli_close($conn);

                ?>
        </div>

        <div class="arrow-btn arrow-right">
            <i class="fa fa-arrow-right"></i>
        </div>
    </div>
    
    <div class="testimonial-pagination">
        
    </div>
</div>