<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Uju Alternative Therapies
    </title>

    <!--Relevant Meta Tags-->
    <meta charset="utf-8">
    <meta name="title" content="Uju Alternative Therapies">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="We help people achieve permanent healing from different kinds of diseases, such as High Blood Pressure, Diabetes, Ulcer, Pile, Erectile Dysfunction, using natural and alternative remedies.">
    <meta name="keywords" content="Healing, Diseases, Infection, Infertility, Diabetes, Cancer, Pile, High Blood Pressure (HBP), Ulcer, Infertility, Erectile dysfunction">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="We help people achieve permanent healing from different kinds of diseases, such as High Blood Pressure, Diabetes, Ulcer, Pile, Erectile Dysfunction, using natural and alternative remedies.">
    <meta property="og:image" content="resources/images/uat-social-media-display-image.svg">
    <meta property="og:url" content="index.html">

    <meta property="twitter:title" content="Uju Alternative Therapies">
    <meta property="twitter:description" content="We help people achieve permanent healing from different kinds of diseases, such as High Blood Pressure, Diabetes, Ulcer, Pile, Erectile Dysfunction, using natural and alternative remedies.">
    <meta property="twitter:image" content="resources/images/uat-social-media-display-image.svg">
    <meta property="twitter:url" content="index.html">

    <!--Cache control-->
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate, post-check=0, pre-check=0">
    <!-- Will remove this comment tag later
    <meta http-equiv="cache-control" content="max-age=86400"> The browser should cache our webpage for only 24hrs, after which it would have to reload every resource of the webpage-->
    
    <!--Useful links-->
    <link href="resources/images/uat-web-icon.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="resources/css/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
    <link href="resources/css/styles.css" rel="stylesheet" type="text/css">
    <script src="resources/js/script.js" type="text/javascript"></script>
    <!--Link to Chimaobi's Testimonial Slider-->
    <script src="resources/js/chimaobi_testimonial_slider.js" type="text/javascript"></script>
    <link href="resources/css/chimaobi_testimonial_slider.css" rel="stylesheet" type="text/css">
</head>
<body>

    <!--Header Section-->
    <?php
        include "header.php"
    ?>

    <main>
        <!--Hero Section-->
        <section class="hero-section" style="background-image: linear-gradient(rgba(89 55 45 / 85%), rgba(89 55 45 / 85%)), url(resources/images/pexels-alleksana-4113900.jpg);">
            <div class="hero-container">
                <div class="row">
                    <div class="column hero-caption">
                        <h1>Welcome to Uju Alternative Therapies</h1>
                        <p> We have helped several people heal from different debilitating diseases. We believe that any disease can be treated, as long as there are no completely damaged organs.</p> 
                        <p> Whether it is cancer, infertility, high blood pressure, erectile dysfunction, pile, ulcer, etc., our Healing Coach/Health Therapist is ready to help you achieve total healing.</p>
                        
                        <!--Our Hero Call to Action (CTA) Button -->
                        <a href="#" class="hero-button">Book Appointment</a>
                    </div>
                    <div class="column hero-img-container">
                        <img src="resources/images/pexels-nataliya-vaitkevich-7615477.jpg" alt="Natural Herbs" class="hero-img">
                    </div>
                </div>                
            </div>
        </section>

        <!--Testimonials Section-->
        <section class="testimonials">
            <?php
                include "testimonial.php"
            ?>
        </section>

    </main> 
    
</body>
</html>