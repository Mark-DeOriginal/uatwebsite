<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Uju Alternative Therapies
    </title>

    <!-- Relevant Meta Tags -->    
    <meta charset="utf-8">
    <meta name="theme-color" content="#564540">
    <meta name="title" content="Uju Alternative Therapies">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="We help people achieve permanent healing from different kinds of diseases, such as High Blood Pressure, Diabetes, Ulcer, Pile, Erectile Dysfunction, using natural and alternative remedies.">
    <meta name="keywords" content="Healing, Diseases, Infection, Infertility, Diabetes, Cancer, Pile, High Blood Pressure (HBP), Ulcer, Infertility, Erectile dysfunction">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Uju Alternative Therapies">
    <meta property="og:description" content="We help people achieve permanent healing from different kinds of diseases, such as High Blood Pressure, Diabetes, Ulcer, Pile, Erectile Dysfunction, using natural and alternative remedies.">
    <meta property="og:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="og:url" content="http://localhost/uatwebsite/index.php>

    <meta property="twitter:title" content="Uju Alternative Therapies">
    <meta property="twitter:description" content="We help people achieve permanent healing from different kinds of diseases, such as High Blood Pressure, Diabetes, Ulcer, Pile, Erectile Dysfunction, using natural and alternative remedies.">
    <meta property="twitter:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="twitter:url" content="http://localhost/uatwebsite/index.php">

    <!-- Cache control -->
    <meta http-equiv="cache-control" content="max-age=3600">
    
    <!--Useful links-->
    <link href="resources/images/uat-web-icon.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="resources/css/fontawesome-6.4.0/css/all.min.css" type="text/css">
    <link href="resources/css/styles.css" rel="stylesheet" type="text/css">

    <script src="resources/js/script.js" type="text/javascript"></script>
    <script src="resources/js/subscribe.js" type="text/javascript"></script>

    <!-- Link to Chimaobi's Testimonial Slider -->
    <script src="resources/js/chimaobi-testimonial-slider.js" type="text/javascript"></script>
    <link href="resources/css/chimaobi-testimonial-slider.css" rel="stylesheet" type="text/css">
</head>
<body>

    <!--Header Section-->
    <?php
        include "header.php";
    ?>

    <main>
        <!-- Hero Section -->
        <section class="hero-section" style="background-image: linear-gradient(rgba(89 55 45 / 85%), rgba(89 55 45 / 85%)), url(resources/images/pexels-alleksana-4113900.jpg);">
            <div class="container">
                <div class="row">
                    <div class="column hero-caption">
                        <h1>Welcome to Uju <br>Alternative Therapies</h1>
                        <p> We believe that any disease is curable, as long as there are no completely damaged organs. Through our expertise, we have helped several people heal from different diseases.</p> 
                        <p> Whether it is cancer, infertility, high blood pressure, erectile dysfunction, pile, ulcer, etc., our Healing Coach/Health Therapist is ready to help you achieve total healing.</p>
                        
                        <!-- Our Hero Call to Action (CTA) Button -->
                        <a href="#" class="hero-button button">Book Appointment</a>
                    </div>
                    
                    <img src="resources/images/pexels-stanislav-kondratiev-9226260.jpg" alt="Natural Herbs" class="hero-img column hero-img-container">       
                </div>                
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials">
            <?php
                include "testimonial.php"
            ?>
        </section>

        <!-- Our Approach -->
        <section class="our-approach">
            <div class="wrapper">
                <img src="resources/images/herbs-for-detox.jpg" alt="Our approach">
                <script>
                    //  Let's load a smaller/bigger sized image based on screen size
                    var browserWidth = window.innerWidth;
                    var img = browserWidth > 770 ? 'resources/images/herbs-for-detox.jpg' : 'resources/images/herbs-for-detox-mobile.jpg';
                    var ourApproachImage = document.querySelector(".our-approach .wrapper > img");
                    ourApproachImage.setAttribute("src", img);

                    window.onresize = function() {
                        browserWidth = window.innerWidth;
                        img = browserWidth > 770 ? 'resources/images/herbs-for-detox.jpg' : 'resources/images/herbs-for-detox-mobile.jpg'
                        ourApproachImage.setAttribute("src", img);
                    }
                </script>
                <div class="container">
                    <div>
                        <h2 class="heading">Our Approach</h2>
                        <p>
                            At Uju Alternative Therapies, we understand that individuals differ and that people may react differently 
                            to certain therapies. Also, what works for one, may not work for all. So, rather than using a one-size-fits-all approach, we make sure to use an approach that is tailored to each individual.</p>
                        <p>
                            Our approach to addressing any health challenge, involves:
                        </p>
                    </div>
                    
                    <div class="list">
                        <div class="item">
                            <div class="number">
                                <span class="number">1</span>
                            </div>
                            <div class="content">
                                <h3 class="heading">Diagnosis</h3>
                                <p class="description">We accurately diagnose the root cause of the disease by carrying out a Root Cause Diagnosis (RCD) Test on the Patient. This is important for the next step.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="number">
                                <span class="number">2</span>
                            </div>
                            <div class="content">
                                <h3 class="heading">Recommendation</h3>
                                <p class="description">We carefully review the RCD Test Report and decide on the right combination of therapies and medicines needed to address the disease.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="number">
                                <span class="number">3</span>
                            </div>
                            <div class="content">
                                <h3 class="heading">Application</h3>
                                <p class="description">We help guide the patient on how to apply the remedies in the Recommendation, for gradual recovery and lasting healing.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Services -->
        <section class="our-services">
            <div class="wrapper">
                <div class="container">
                    <h2>Our Services</h2>
                    <p>Below is a list of some of the Services we offer at Uju Alternative Therapies.</p>
                    
                    <div class="list">
                        <div class="row">
                            <div class="item">
                                <h3>Healing and Wellness Guide/Coaching</h3>
                                <p>It’s our main objective to ensure that our clients not only recover from diseases but also stay healthy to live their best lives.</p>                            
                            </div>
                            <div class="item">
                                <h3>Sales of Healing and Wellness Products</h3>
                                <p>We sell unique healing and health promoting products like healing gadgets, weight loss devices, detox kits, Chinese herbs, supplements, etc.</p>                        
                            </div>
                            <div class="item">
                                <h3>Design of Personalized Weight Loss Programs</h3>
                                <p>We design personalized and effective weight loss programs that works by addressing the root cause of the excess weight gain.</p>                        
                            </div>
                        </div>

                        <div class="row">
                            <div class="item">
                                <h3>Design of Anti-aging Programs</h3>
                                <p>We design anti-aging programs to help interested clients slow down aging, including reversing of rapid aging effects, using certain bio-hacking techniques. </p>                        
                            </div>
                            <div class="item">
                                <h3>Root Cause Diagnosis (RCD) Test</h3>
                                <p>We perform Root Cause Diagnosis Tests that helps detect imbalances in the body that may be causing diseases.</p>                        
                            </div>
                            <div class="item">
                                <h3>Health Consultation</h3>
                                <p>We offer professional Health Consultation Services, where interested clients can have a one-on-one interactive session with our Health Professional.</p>                        
                            </div>
                        </div>
                    </div>                    
                </div>
                <img src="resources/images/calliope_coach_therapist-1000x667.jpg" class="img" alt="Image showing/portraying services."> 
            </div>
        </section>
        
        <!-- Our Healing Modalities -->
        <section class="healing-modalities">
            <div class="wrapper">
            <img src="resources/images/traditional-chinese-medicine.jpg" class="img" alt="Image of Traditional Chinese Medicine."> 
                <div class="container">
                    <h2>Our Healing Modalities</h2>
                    <p>Some of the methods, practices and techniques we employ to help our patients achieve lasting healing and to promote wellness, includes:</p>
                    <ul class="list">
                        <li><i class="fa-sharp fa-regular fa-circle-check"></i>Traditional Chinese Medicine</li>
                        <li><i class="fa-sharp fa-regular fa-circle-check"></i>Cornerstone Kinesiology</li>
                        <li><i class="fa-sharp fa-regular fa-circle-check"></i>Electromagnetic Therapy</li>
                        <li><i class="fa-sharp fa-regular fa-circle-check"></i>Chromotherapy</li>
                        <li><i class="fa-sharp fa-regular fa-circle-check"></i>Zap Therapy</li>
                        <li><i class="fa-sharp fa-regular fa-circle-check"></i>Homeopathy</li>
                        <li><i class="fa-sharp fa-regular fa-circle-check"></i>Naturopathy</li>
                        <li><i class="fa-sharp fa-regular fa-circle-check"></i>Reflexology, etc.</li>
                    </ul>
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