<?php 
    include "get-contact-info.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Contact Us
    </title>

    <!--Relevant Meta Tags-->    
    <meta charset="utf-8">
    <meta name="theme-color" content="#564540">
    <meta name="title" content="Contact Us">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Want to get in touch with us, check our contact information.">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Contact Us">
    <meta property="og:description" content="Want to get in touch with us, check our contact information.">
    <meta property="og:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="og:url" content="http://localhost/uatwebsite/contact-us.php">

    <meta property="twitter:title" content="Contact Us">
    <meta property="twitter:description" content="Want to get in touch with us, check our contact information.">
    <meta property="twitter:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="twitter:url" content="http://localhost/uatwebsite/contact-us.php">

    <!--Cache control-->
    <meta http-equiv="cache-control" content="max-age=3600">
    
    <!--Useful links-->
    <link href="resources/images/uat-web-icon.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="resources/css/fontawesome-6.4.0/css/all.min.css" type="text/css">
    <link href="resources/css/styles.css" rel="stylesheet" type="text/css">
    <link href="resources/css/contact-us.css" rel="stylesheet" type="text/css">

    <script src="resources/js/script.js" type="text/javascript"></script>
    <script src="resources/js/subscribe.js" type="text/javascript"></script>
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
                <h1>Contact Us</h1>
                <p>Want to get in touch with us? We would be glad to hear from you. <br> Here is our contact information.</p>
            </div>            
        </section>

        <!-- FAQs Section -->
        <section class="contact-info">
            <div class="container">
                <div class="contact">
                    <h4><i class="fa fa-location-dot" aria-hidden="true"></i>Address</h4>
                    <p><?php echo $contact_info['address']; ?></p><br>

                    <h4><i class="fab fa-whatsapp"></i>WhatsApp/Call</h4>
                    <p><?php echo $contact_info['phone_number']; ?></p><br>

                    <h4><i class="fa-regular fa-envelope"></i>Email</h4>
                    <p><?php echo $contact_info['email']; ?></p><br>

                    <h4><i class="fas fa-users follow-icon"></i>Follow our socials</h4>
                    <div class="socials">
                        <a href="<?php echo $contact_info['facebook_link']; ?>"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo $contact_info['twitter_link']; ?>"><i class="fab fa-twitter"></i></a>
                        <a href="<?php echo $contact_info['instagram_link']; ?>"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo $contact_info['tiktok_link']; ?>"><i class="fab fa-tiktok"></i></a>
                        <a href="<?php echo $contact_info['linkedin_link']; ?>"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>                
            </div> 
        </section>

        <?php 
            mysqli_close($conn);
        ?>

        <!-- Call to Action (CTA) Section -->
        <?php 
            include "cta-section.php";
        ?>

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