<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        About Us
    </title>

    <!--Relevant Meta Tags-->    
    <meta charset="utf-8">
    <meta name="theme-color" content="#564540">
    <meta name="title" content="About Us - Uju Alternative Therapies">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="We help people achieve permanent healing from different kinds of diseases, such as High Blood Pressure, Diabetes, Ulcer, Pile, Erectile Dysfunction, using natural and alternative remedies.">
    <meta name="keywords" content="Healing, Diseases, Infection, Infertility, Diabetes, Cancer, Pile, High Blood Pressure (HBP), Ulcer, Infertility, Erectile dysfunction">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="About Us - Uju Alternative Therapies">
    <meta property="og:description" content="We help people achieve permanent healing from different kinds of diseases, such as High Blood Pressure, Diabetes, Ulcer, Pile, Erectile Dysfunction, using natural and alternative remedies.">
    <meta property="og:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="og:url" content="http://localhost/uatwebsite/about-us.php">

    <meta property="twitter:title" content="About Us - Uju Alternative Therapies">
    <meta property="twitter:description" content="We help people achieve permanent healing from different kinds of diseases, such as High Blood Pressure, Diabetes, Ulcer, Pile, Erectile Dysfunction, using natural and alternative remedies.">
    <meta property="twitter:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="twitter:url" content="http://localhost/uatwebsite/about-us.php">

    <!--Cache control-->
    <meta http-equiv="cache-control" content="max-age=3600">
    
    <!--Useful links-->
    <link href="resources/images/uat-web-icon.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="resources/css/fontawesome-6.4.0/css/all.min.css" type="text/css">
    <link href="resources/css/styles.css" rel="stylesheet" type="text/css">
    <link href="resources/css/about-us.css" rel="stylesheet" type="text/css">

    <script src="resources/js/script.js" type="text/javascript"></script>
    <script src="resources/js/subscribe.js" type="text/javascript"></script>
</head>
<body>

    <!-- Header Section -->
    <?php
        include "header.php";
    ?>

    <main>
        <!-- Who we are -->
        <section class="who-we-are">
            <div class="container">
                <h1>About Us</h1>
                <h2>Who We Are</h2>
                <p>Uju Alternative Therapies is a wellness center created to provide natural and alternative remedies to help people heal from complicated and chronic diseases, and help them live a healthier life, free from debilitating & degenerating diseases.</p>
            </div>            
        </section>

        <!-- Our Vision and Mission -->
        <section class="vision-and-mission about-us-info">
            <div class="container">
                <div class="our-vision">
                    <h2>Our Vision</h2>
                    <p><span class="quote open">"</span>To increase awareness of natural & alternative remedies to diseases, as well as provide guidance to their effective application for healing and wellness.<span class="quote close">"</span></p>
                </div>
                <div class="our-mission">
                    <h2>Our Mission</h2>
                    <p><span class="quote open">"</span>To be successful at helping people live life without degenerating and chronic diseases.<span class="quote close">"</span></p>
                </div>
            </div>            
        </section>

        <!-- Why Us? -->
        <section class="why-choose-us about-us-info">
            <div class="container">
                <div class="column img-container">                
                    <img src="resources/images/pexels-rdne-stock-project-8313254.jpg">
                </div>
                <div class="column">                    
                    <h2>Why Choose Us?</h2>
                    <p>We have a unique approach that works in tackling any health challenge. We start by identifying the root cause, after which we recommend effective, natural and alternative remedies to address the health challenge, resulting in total and permanent healing. If you've tried out numerous remedies without achieving lasting relief, we are here to make a difference.</p>
                </div>
            </div>
        </section>

        <!-- What we do -->
        <section class="about-us-info">
            <div class="container">
                <div class="column">                    
                    <h2>What We Do!</h2>
                    <p>Healing and wellness guide/coaching, Root Cause Diagnosis Test, health consultation, sales of healing and wellness products, design of anti-aging and personalized weight loss programs among others, are some of the services we provide. So whether you're experiencing a health challenge, trying to lose weight, reverse aging or want to have an interactive session with a health professional, we've got you covered.</p>
                </div>
                <div class="column img-container">                
                    <img src="resources/images/pexels-nataliya-vaitkevich-7615463.jpg">
                </div>
            </div>          
        </section>

        <!-- What We Address -->
        <section class="about-us-info">
            <div class="container">
                <div class="column img-container">                
                    <img src="resources/images/171120-smile-stock-njs-333p.jpg">
                </div>
                <div class="column">                    
                    <h2>What We Address</h2>
                    <p>We address a wide range of health challenges using a personalized approach that is tailored to each individual. Some of the health challenges we address include, Asthma, Diabetes, Hepatitis A/B/C, Hormonal Imbalance, Insulin Resistance, High and Low Blood Pressure, Appendicitis, Glaucoma, Recurring Typhoid and Malaria, Infertility, Erectile Dysfunction, Tumors and Cancer, Cataract, Autoimmune Disorder, Ulcer, Pile, etc.</p>
                </div>
            </div>
        </section>

        <!-- Founder's Short Bio Section -->
        <section class="founder-short-bio">
            <div class="container">
                <img src="resources/images/dr-peter.JPG" alt="Image of the founder of Uju Alternative Therapies">
                <div class="bio">
                    <h4>Dr. Peter Emeka</h4>
                    <p>Founder/Healing and Wellness Coach,<br>Uju Alternative Therapies</p>
                </div>
            </div>
        </section>
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