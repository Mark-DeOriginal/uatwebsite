<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Testimonials
    </title>

    <!--Relevant Meta Tags-->    
    <meta charset="utf-8">
    <meta name="theme-color" content="#564540">
    <meta name="title" content="Testimonials">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Through our expertise, we have helped several people heal from different debilitating diseases.">
    <meta name="keywords" content="Infection, Infertility, Diabetes, Cancer, Pile, High Blood Pressure (HBP), Ulcer, Infertility, Erectile dysfunction">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Testimonials">
    <meta property="og:description" content="Through our expertise, we have helped several people heal from different debilitating diseases.">
    <meta property="og:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="og:url" content="http://localhost/uatwebsite/testimonials.php">

    <meta property="twitter:title" content="Testimonials">
    <meta property="twitter:description" content="Through our expertise, we have helped several people heal from different debilitating diseases.">
    <meta property="twitter:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="twitter:url" content="http://localhost/uatwebsite/testimonials.php">

    <!--Cache control-->
    <meta http-equiv="cache-control" content="max-age=3600">

    <base href="/uatwebsite/">
    
    <!--Useful links-->
    <link href="resources/images/uat-web-icon.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="resources/css/fontawesome-6.4.0/css/all.min.css" type="text/css">
    <link href="resources/css/styles.css" rel="stylesheet" type="text/css">
    <link href="resources/css/testimonials.css" rel="stylesheet" type="text/css">

    <script src="resources/js/script.js" type="text/javascript"></script>
    <script src="resources/js/email-handler.js" type="text/javascript"></script>
</head>
<body>

    <!-- Header Section -->
    <?php
        include "header.php";
    ?>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <h1>Testimonials</h1>
                <p>Through our expertise in handling different kinds of health challenges, we have helped several people achieve lasting and permanent healing. </p>
                <p>Here are some testimonials.</p>
            </div>            
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials">
            <div class="container">
                <div class="testimonial-wrapper">

                    <?php

                        //  Connect to the uat_database
                        require_once "database-connect.php";

                        $canShowPagination = true;
                        
                        $testimonialsPerPage = 3;

                        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['page'])) {

                            $isValidPageNumber = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
                            
                            $pageNumber = "";
                            
                            if ($isValidPageNumber !== false && $isValidPageNumber > 0) {
                                $pageNumber = $_GET['page'];

                                $testimonialToViewFrom = ($pageNumber * $testimonialsPerPage) - $testimonialsPerPage + 1;
                            
                                //  Let's select the number of rows we want per page from the uat_testimonials table
                                $sql = "SELECT * FROM uat_testimonials WHERE id >= '$testimonialToViewFrom' LIMIT $testimonialsPerPage";
                                $testimonials = mysqli_query($conn, $sql);

                                $noOfTestimonials = mysqli_num_rows($testimonials);

                                if ($noOfTestimonials > 0) {

                                    while ($testimonial = mysqli_fetch_assoc($testimonials)) { ?>
                                        <div class="testimonial">
                                            <div class="header">
                                                <div class="avatar">
                                                    <img src="<?php echo $testimonial['avatar'] ?>" alt="Testifier image">
                                                </div>
                                                <div class="caption">
                                                    <h3><?php echo $testimonial['name'] ?></h3>
                                                    <p><i class="fa fa-location-dot" aria-hidden="true"></i><?php echo $testimonial['location'] ?></p>
                                                </div>
                                            </div>
                                            <div class="body">
                                                <?php echo $testimonial['testimony']?>
                                            </div>
                                            <div class="footer">
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
                    <?php           }

                                    $sql = "SELECT * FROM uat_testimonials";
                                    $noOfTestimonials = mysqli_num_rows(mysqli_query($conn, $sql));

                                    $isFirstPage = $pageNumber == 1 ? true : false;
                                    $isLastPage = $noOfTestimonials <= $testimonialsPerPage * $pageNumber ? true : false;

                                    if ($noOfTestimonials > $testimonialsPerPage) {
                                        $canShowPagination = true;
                                    } else {
                                        $canShowPagination = false;
                                    }

                                } else { 
                    ?>
                                    <script>
                                        window.location.href = "testimonials";
                                    </script>
                    <?php       }
                            } else { 
                    ?>
                                <script>
                                    window.location.href = "testimonials";
                                </script>
                    <?php   }
                            
                        } else {

                            $pageNumber = 1;

                            //  Let's select the first three rows in the uat_testimonials table
                            $sql = "SELECT * FROM uat_testimonials LIMIT $testimonialsPerPage";
                            $testimonials = mysqli_query($conn, $sql);

                            $noOfTestimonials = mysqli_num_rows($testimonials);

                            if ($noOfTestimonials > 0) {

                                while ($testimonial = mysqli_fetch_assoc($testimonials)) { ?>
                                    <div class="testimonial">
                                        <div class="header">
                                            <div class="avatar">
                                                <img src="<?php echo $testimonial['avatar'] ?>" alt="Testifier image">
                                            </div>
                                            <div class="caption">
                                                <h3><?php echo $testimonial['name'] ?></h3>
                                                <p><i class="fa fa-location-dot" aria-hidden="true"></i><?php echo $testimonial['location'] ?></p>
                                            </div>
                                        </div>
                                        <div class="body">
                                            <?php echo $testimonial['testimony']?>
                                        </div>
                                        <div class="footer">
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
                    <?php       }

                                $sql = "SELECT * FROM uat_testimonials";
                                $noOfTestimonials = mysqli_num_rows(mysqli_query($conn, $sql));

                                $isFirstPage = $pageNumber == 1 ? true : false;
                                $isLastPage = $noOfTestimonials <= $testimonialsPerPage * $pageNumber ? true : false;

                                if ($noOfTestimonials > $testimonialsPerPage) {
                                    $canShowPagination = true;
                                } else {
                                    $canShowPagination = false;
                                }

                            } else {
                                $canShowPagination = false; 
                    ?>
                                <p class="no-testimonial-msg">There are currently no testimonials to view. <br>This could be as a result of an error. Please check back later.</p>
                    <?php   }
                        }
                    ?>
                </div>

                <?php 
                    if ($canShowPagination == true) { ?>
                        <div class="pagination-wrapper">
                            <form method="GET" action="<?php echo explode(".", $_SERVER['PHP_SELF'])[0]?>">
                                <input type="hidden" name="page" value="<?php echo $pageNumber > 1 ? $pageNumber - 1 : $pageNumber; ?>">
                                <button type="submit" class="pagination-btn prev"><i class="fa fa-arrow-left prev"></i>Previous</button>
                            </form>
                            <form method="GET" action="<?php echo explode(".", $_SERVER['PHP_SELF'])[0]?>">
                                <input type="hidden" name="page" value="<?php echo $pageNumber + 1; ?>">
                                <button type="submit" class="pagination-btn next">Next<i class="fa fa-arrow-right next"></i></button>
                            </form>
                        </div>
                        
                        <?php 
                            
                            if ($isFirstPage == true) { ?>
                                <script>
                                    var prevBtn = document.querySelector(".pagination-btn.prev");
                                    prevBtn.classList.add("disabled");
                                    prevBtn.disabled = true;
                                </script>
                        <?php
                            }

                            if ($isLastPage == true) { ?>
                                <script>
                                    var nextBtn = document.querySelector(".pagination-btn.next");
                                    nextBtn.classList.add("disabled");
                                    nextBtn.disabled = true;
                                </script>
                        <?php
                            }
                    }
                ?>                              
            </div>                     
        </section>
        
        <!-- Call to Action (CTA) Section -->
        <section class="cta-section">
            <div class="container">
                <div class="column">
                    <p>Would you like to have a session with our Health Professional?</p>
                    <a href="#" class="cta-btn button">Book Appointment</a>                                
                </div>
                <div class="column">
                    <img src="resources/images/therapist-session-img.svg" alt="Therapist session image">
                </div>                
            </div>
        </section>

        <!-- Footer Section -->
        <section class="footer">
            <div class="container">
                <?php     
                    include "footer/about-us.php"; 
                    
                    include "footer/contact-us.php";

                    include "footer/links.php";

                    include "footer/subscription-form.php";

                    include "footer/copyright.php";
                ?>
            </div> 
        </section>

        <!-- Modals -->
        <div class="modal-container">
            <div class="loading-indicator">
                <div class="loader"></div>
                <p>Please wait</p>
            </div>

            <div class="modal subscription-status-modal">
                <h2 class="heading"></h2>
                <p class="message"></p>
                <div class="btn-container">
                    <button type="button" class="modal-close-btn button">Close</button>
                </div>
                
            </div>
        </div>
    </main> 
    
</body>
</html>