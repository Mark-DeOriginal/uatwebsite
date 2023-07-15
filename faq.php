<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6PEG72CWXN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-6PEG72CWXN');
    </script>
    
    <title>
        Frequently Asked Questions
    </title>

    <!--Relevant Meta Tags-->    
    <meta charset="utf-8">
    <meta name="theme-color" content="#564540">
    <meta name="title" content="Frequently Asked Questions">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Answers to some frequently asked questions.">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Frequently Asked Questions">
    <meta property="og:description" content="Answers to some frequently asked questions.">
    <meta property="og:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="og:url" content="http://localhost/uatwebsite/faq.php">

    <meta property="twitter:title" content="Frequently Asked Questions">
    <meta property="twitter:description" content="Answers to some frequently asked questions.">
    <meta property="twitter:image" content="http://localhost/uatwebsite/resources/images/uat-social-media-display-image.svg">
    <meta property="twitter:url" content="http://localhost/uatwebsite/faq.php">

    <!--Cache control-->
    <meta http-equiv="cache-control" content="max-age=3600">
    
    <!--Useful links-->
    <link href="resources/images/uat-web-icon.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="resources/css/fontawesome-6.4.0/css/all.min.css" type="text/css">
    <link href="resources/css/styles.css" rel="stylesheet" type="text/css">
    <link href="resources/css/faq.css" rel="stylesheet" type="text/css">

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
                <h1>Frequently Asked Questions</h1>
                <p>Here are answers to some questions you may have about us or our services. Click on any question to show the answer.</p>
            </div>            
        </section>

        <!-- FAQs Section -->
        <section class="faqs">
            <div class="container">
                <?php 
                    //  Connect to the uat_database
                    require_once "database-connect.php";

                    //  Select all the rows in the faqs table
                    $sql = "SELECT * FROM faqs";
                    $faqs = mysqli_query($conn, $sql);

                    //  Display the rows in their respective elements
                    while ($faq = mysqli_fetch_assoc($faqs)) { ?>
                        <div class="faq">
                            <div class="header">
                                <div class="title">
                                    <p><?php echo $faq['faq']?></p>
                                </div>
                                <div class="toggle-icon">
                                    <i class="fa-sharp fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                            <div class="body">
                                <div class="content">
                                    <?php echo $faq['answer']?>
                                </div>                        
                            </div>                    
                        </div>
                <?php  
                    }

                    mysqli_close($conn);
                ?>
            </div>
            
            <script>
                //  Get the header of all the faq elements
                var faqHeaders = document.querySelectorAll(".faqs .faq .header");

                //  If at least one faq exists, continue
                if (faqHeaders.length > 0) {
                    //  Select the first faq's header and body elements
                    var firstFaqHeader = faqHeaders[0];                
                    var firstFaqBody = firstFaqHeader.nextElementSibling;
                    
                    //  This will be added to our faqs body element's height, when clicked
                    var extraHeight = 40;

                    //  Open the first faq once the page is loaded
                    firstFaqBody.style.maxHeight = firstFaqBody.scrollHeight + extraHeight + "px";

                    //  Add the opened class to the faq header
                    firstFaqHeader.classList.add("opened");

                    //  For all the faq headers,
                    faqHeaders.forEach(faqHeader => {
                        // attach an event listener to them
                        faqHeader.addEventListener("click", function() {
                            //  Get the faq header's next sibling
                            var faqBody = this.nextElementSibling;

                            //  If a max-height is set already for the element,
                            if (faqBody.style.maxHeight) {
                                // reset it
                                faqBody.style.maxHeight = "";
                            } else {
                                // If not, set the element's max-height with some
                                // extra pixels to cover up for unexpected overflow 
                                faqBody.style.maxHeight = faqBody.scrollHeight + extraHeight + "px";

                                //  Close all other elements that were not clicked
                                for (i = 0; i < faqHeaders.length; i++) {
                                    if (faqHeaders[i] !== faqHeader && faqHeaders[i].classList.contains("opened")) {
                                        faqHeaders[i].nextElementSibling.style.maxHeight = "";
                                        faqHeaders[i].classList.remove("opened");
                                    }
                                }
                            }

                            this.classList.toggle("opened");
                        });
                    });

                } else {
                    // If no faqs exist, show this message
                    document.querySelector("section.faqs .container").innerHTML = '<p class="no-faqs-msg">There are currently no FAQs to display. This may be due to a load error. <br>Try reloading the page, or check back later.</p>';
                }                             
            </script>
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