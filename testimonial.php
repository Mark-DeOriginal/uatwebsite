<!--This is the content of our testimonial section-->
<div class="container">
    <div class="heading-wrapper">
        <h2>Testimonials</h2>
        <!--
        <p>Our Health Therapist/Healing Coach is a knowledgeable and experienced professional with a deep understanding of how the human body works, and how to help the body heal from different diseases.</p> -->
        <p>Here are testimonies from some of our Patients.</p>
    </div>
    
    <div class="testimonial-wrapper">
        <div class="arrow-btn arrow-left btn-disabled">
            <i class="fa fa-arrow-left"></i>
        </div>

        <div class="testimonial-container slider">

            <?php
            // Let's provide our connection details
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "uat_database";

            $conn = mysqli_connect($host, $username, $password, $dbname);

            $sql = "SELECT * FROM uat_testimonials";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) { ?>
                
                <div class="card">
                    <div class="column">
                        <div class="row">
                            <div class="card-header">
                                <div class="image">
                                    <img src="<?php echo $row['avatar'] ?>" alt="Testifier">
                                </div>
                                <div class="caption">
                                    <h3><?php echo $row['name'] ?></h3>
                                    <p><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $row['location'] ?></p>
                                </div>
                            </div>                                    
                            <div class="card-body">
                                <p><?php echo $row['testimony_summary'] ?></p>
                            </div>
                        </div>
                        <div class="row card-footer">
                            <?php                            
                                $illness_tags = explode(",", $row['illness_tags']);

                                foreach ($illness_tags as $tag) {
                                    echo '<span class="tag">' . trim($tag) . '</span>';
                                }
                            ?>                            
                        </div>
                    </div>
                </div>
                <?php
            }
                ?>
        </div>

        <div class="arrow-btn arrow-right">
            <i class="fa fa-arrow-right"></i>
        </div>
    </div>
    
    <div class="testimonial-pagination">
        
    </div>
</div>