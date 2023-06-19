<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Subscribe to our mailing list
    </title>

    <meta charset="utf-8">
    <meta name="title" content="Uju Alternative Therapies">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Cache control-->
    <meta http-equiv="cache-control" content="max-age=3600">
    
    <!--Useful links-->
    <link href="resources/images/uat-web-icon.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="resources/css/fontawesome-6.4.0/css/all.min.css" type="text/css">
    <link href="resources/css/styles.css" rel="stylesheet" type="text/css">
    <link href="resources/css/subscribe.css" rel="stylesheet" type="text/css">

    <script src="resources/js/script.js" type="text/javascript"></script>
    <script src="resources/js/email-handler.js" type="text/javascript"></script>
</head>
<body>
        
    <?php
        require "header.php";
    ?>

    <main>
        <section class="subscription-container">
            <h2>Subscribe to <br>Our Mailing List</h2>
            <p>Get occasional health updates.</p>
            <form id="subscription-form">
                <input type="text" name="fname" placeholder="First name" required>
                <input type="email" name="email" placeholder="Email address" required>
                
                <div class="submit-btn-container">
                    <input type="submit" value="Subscribe" class="send-email-btn">
                </div>            
            </form>
        </section>

        <!-- Footer Section -->
        <section class="footer">
            <div class="container">
                <?php     
                    include "footer/about-us.php"; 
                    
                    include "footer/contact-us.php";

                    include "footer/links.php";

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

