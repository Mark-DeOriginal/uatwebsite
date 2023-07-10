<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Book Appointment
    </title>

    <!--Relevant Meta Tags-->    
    <meta charset="utf-8">
    <meta name="theme-color" content="#564540">
    <meta name="title" content="Book Appointment">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Book an appointment with our health professional/healing coach, to get lasting and permanent solution to that health challenge.">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Book Appointment">
    <meta property="og:description" content="Book an appointment with our health professional/healing coach, to get lasting and permanent solution to that health challenge.">
    <meta property="og:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="og:url" content="http://localhost/uatwebsite/book-appointment.php">

    <meta property="twitter:title" content="Book Appointment">
    <meta property="twitter:description" content="Book an appointment with our health professional/healing coach, to get lasting and permanent solution to that health challenge.">
    <meta property="twitter:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="twitter:url" content="http://localhost/uatwebsite/book-appointment.php">

    <!--Cache control-->
    <meta http-equiv="cache-control" content="max-age=3600">
    
    <!--Useful links-->
    <link href="resources/images/uat-web-icon.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="resources/css/fontawesome-6.4.0/css/all.min.css" type="text/css">
    <link href="resources/css/styles.css" rel="stylesheet" type="text/css">
    <link href="resources/css/book-appointment.css" rel="stylesheet" type="text/css">

    <script src="resources/js/script.js" type="text/javascript"></script>
    <script src="resources/js/book-appointment.js" type="text/javascript"></script>
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
                <h1>Book Appointment</h1>
                <p>An appointment with our health professional is the first step in your health and wellness journey with us, to achieving lasting and permanent healing. Continue with the form below.</p>
            </div>            
        </section>

        <!-- Book Appointment Section -->
        <section class="book-appointment">
            <div class="container">
                <form method="POST" action="<?php echo explode(".", $_SERVER['PHP_SELF'])[0]?>">
                    <input type="text" name="fullname" placeholder="Full name" class="text-input" required>
                    <input type="text" name="email" placeholder="Email address" class="text-input" required>
                    <input type="text" name="phone" placeholder="Phone number" class="text-input" required>
                    <input type="hidden" value="" name="consultation-type" class="consultation-type-choice">
                    <div class="consultation-type-wrapper">
                        <div class="consultation-type dropdown-btn">
                            <p class="choice">Consultation type</p>
                            <div class="toggle-icon">
                                <i class="fa-sharp fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="dropdown list">
                            <ul>
                                <li>Consultation type...</li>
                                <li>Physical</li>
                                <li>Online</li>
                            </ul>
                        </div>
                    </div>
                    <div class="consultation-date-wrapper">
                        <label for="c-date">Consultation date</label>
                        <input type="date" name="c-date" id="c-date" required>
                    </div>
                    <div class="upload-wrapper">
                        <p>Upload relevant files</p>
                        <p class="info">Example: test result, medical history, etc. (Optional)</p>
                        <button type="button" class="choose-file-btn">Upload file</button>
                        <div class="files-wrapper">

                        </div>
                    </div> 
                    <textarea name="message" placeholder="Message (Optional)" class="message"></textarea>
                    <div class="pricing-area">
                        <div class="header">
                            <h4>Please note</h4>
                        </div>
                        <div class="body">
                            <div class="price-list">
                                <p>Consultation Fee: ₦10,000</p>
                                <p>Root Cause Diagnosis Test: ₦20,000</p>
                            </div>
                            <div class="payment-info">
                                <p><b>You can pay in person or to the account below:</b></p>
                                <p>Account number<br><b>1001202518</b></p>
                                <p>Account name<br><b>Uju Alternative Therapies Ltd</b></p>
                                <p>Bank name<br><b>Lotus Bank</b></p>
                            </div>
                        </div>
                        <div class="payment-upload">
                            <p>Upload payment receipt</p>
                            <input type="file" name="payment-upload" class="uploader">
                        </div>
                    </div>
                    
                    <input type="submit" value="Book appointment" name="submit" class="book-appointment-btn">
                </form>
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