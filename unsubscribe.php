<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Manage Subscription
    </title>

    <meta charset="utf-8">
    <meta name="theme-color" content="#564540">
    <meta name="title" content="Uju Alternative Therapies">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Cache control-->
    <meta http-equiv="cache-control" content="max-age=3600">
    
    <base href="/uatwebsite/">
    
    <!--Useful links-->
    <link href="resources/images/uat-web-icon.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="resources/css/fontawesome-6.4.0/css/all.min.css" type="text/css">
    <link href="resources/css/styles.css" rel="stylesheet" type="text/css">
    <link href="resources/css/unsubscribe.css" rel="stylesheet" type="text/css">

    <script src="resources/js/script.js" type="text/javascript"></script>
</head>
<body>

    <?php
        include "header.php";
    ?>
    
    <main>
        <section class="container">
            <div class="confirm-unsubscription-message">    
    <?php

        session_start();

        //  Connect to the uat_database
        require_once "database-connect.php";

        if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['confirmation-code'])) {
            
            //  Get the confirmation code
            $confirmationCode = $_GET['confirmation-code'];        

            //  Let's select all the rows in the email_subscribers table,
            //  using the confirmation_code as an Id
            $sql = "SELECT * FROM email_subscribers WHERE confirmation_code ='" . mysqli_real_escape_string($conn, $confirmationCode) . "' LIMIT 1";
            //  Query the database and store the result of the SQL statement
            $result = mysqli_query($conn, $sql);

            //  If a record exists that matches the confirmation code
            if (mysqli_num_rows($result) > 0) {  

                //  Get the fields and values of the record
                $row = mysqli_fetch_assoc($result);

                //  Get these useful fields from the record
                $confirmationStatus = $row['confirmation_status'];
                $subscriptionStatus = $row['subscription_status'];
                $subscriberFName = $row['first_name'];
                $subscriberEmail = $row['email'];

                // If the subscription has been confirmed and the subscription status is 'subscribed'
                if ($confirmationStatus === "Confirmed" && $subscriptionStatus === "Subscribed") {
                    
                    //  Store the subscriber's email in the session 
                    $_SESSION['subscriber_email'] = $subscriberEmail;

                    $isSubscribed = true;

                // But if the subscription status is 'unsubscribed', and the confirmation status is confirmed
                } else if ($confirmationStatus === "Confirmed" && $subscriptionStatus === "Unsubscribed") {

                    $isSubscribed = false;

                } else {
                    // Redirect User to the subscription page
                    header("location: http://localhost/uatwebsite/subscribe");
                }
                
            } else {
                // Redirect User to the subscription page
                header("location: http://localhost/uatwebsite/subscribe");
            }

            if ($isSubscribed == true) { ?>
                <h2>Confirm <br>Unsubscription</h2>
                <p> Hello, <?php echo $subscriberFName ?>.</p>
                <p> Looks like you want to unsubscribe from our mailing list. Doing so means you will no longer
                    receive occasional health updates from us to your email, <?php echo $subscriberEmail ?> until you subscribe again.
                </p>
                <p> Are you sure you want to unsubscribe?</p>
                <form method="POST" action="<?php echo explode(".", $_SERVER['PHP_SELF'])[0]?>">
                    <input type="submit" value="Yes, unsubscribe" name="unsubscribe" class="unsubscribe-btn">
                </form>
                
<?php       } else { ?>                            
                <h2>Already <br>Unsubscribed!</h2>
                <p>You have already unsubscribed from our mailing list.</p>
<?php       }
        
        } 
                
        else if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['unsubscribe'])) {

            $sql = "SELECT * FROM email_subscribers WHERE email = '" . $_SESSION['subscriber_email'] . "' LIMIT 1";
            $result = mysqli_query($conn, $sql);

            // If a record matches the email, proceed
            if (mysqli_num_rows($result) > 0) {

                $unsubscription_date_Timestamp = date("Y-m-d H:i:s A");

                $sql = "UPDATE email_subscribers SET subscription_status = 'Unsubscribed', date_unsubscribed = '" . $unsubscription_date_Timestamp . "'";
            
                if (mysqli_query($conn, $sql)) { ?>

                    <h2>Unsubscribed <br>Successfully!</h2>
                    <p>Your email, <?php echo $_SESSION['subscriber_email'] ?>, has been removed from our mailing list. You will no longer receive health updates from us until you subscribe again.</p>
<?php           
                } else { ?>

                    <h2>Unsubscribe Error!</h2>
                    <p>An error occurred during the unsubscription process. Please try again.</p>
<?php           }

            // But if no record matches the email,
            } else {
                // Redirect User to the subscription page
                header("location: http://localhost/uatwebsite/subscribe");
            }
        
        //  If the page was visited without the correct link and request method
        } else {
            // Redirect User to the home page
            header("location: http://localhost/uatwebsite/");
        }

        mysqli_close($conn);
?>                
            </div>
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
    </main>
</body>
</html>