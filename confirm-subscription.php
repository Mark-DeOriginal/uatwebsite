<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Subscription Status
    </title>

    <meta charset="utf-8">
    <meta name="title" content="Uju Alternative Therapies">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Cache control-->
    <meta http-equiv="cache-control" content="max-age=3600">
    
    <base href="/uatwebsite/">

    <!--Useful links-->
    <link href="resources/images/uat-web-icon.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="resources/css/fontawesome-6.4.0/css/all.min.css" type="text/css">
    <link href="resources/css/styles.css" rel="stylesheet" type="text/css">
    <link href="resources/css/confirm-subscription.css" rel="stylesheet" type="text/css">

    <script src="resources/js/script.js" type="text/javascript"></script>
</head>
<body>
    <?php
        //  Let's be sure the page was accessed via a GET request,
        //  and that the confirmation code is set in the request
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['confirmation-code'])) {
            
            //  Connect to the uat_database
            require_once "database-connect.php";
            
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

                //  Get the confirmation status from the record
                $confirmationStatus = $row['confirmation_status'];
                $subscriptionStatus = $row['subscription_status'];

                //  If the record has not been confirmed
                if ($confirmationStatus === "Not Confirmed" || $subscriptionStatus === "Unsubscribed") {
                    //  Get the date and time the user subscribed
                    $subscription_date_TimeStamp = $row['subscription_date'];
                    //  Get the current date and time
                    $confirmation_date_TimeStamp = date("Y-m-d H:i:s A");
                    
                    //  Create DateTime objects from the dates
                    $subscription_dateTime = DateTime::createFromFormat("Y-m-d H:i:s A", $subscription_date_TimeStamp);
                    $confirmation_dateTime = DateTime::createFromFormat("Y-m-d H:i:s A", $confirmation_date_TimeStamp);

                    //  Get the time difference
                    $timeDifference = $subscription_dateTime->diff($confirmation_dateTime);
                    
                    $days = $timeDifference->days;
                    $hours = $timeDifference->h;
                    $minutes = $timeDifference->i;
                    $seconds = $timeDifference->s;

                    //  We will store the time lapse here
                    $confirmation_time_lapse = "";

                    //  Any of these with a non-zero value, add it to the time lapse
                    if ($days > 0) {
                        $confirmation_time_lapse .= $days . "d ";
                    }
                    if ($hours > 0) {
                        $confirmation_time_lapse .= $hours . "h ";
                    }
                    if ($minutes > 0) {
                        $confirmation_time_lapse .= $minutes . "m ";
                    }
                    if ($seconds > 0) {
                        $confirmation_time_lapse .= $seconds . "s";
                    }

                    //  Create an array from space-separated strings in the confirmation_time_lapse variable above
                    $timeLapseArray = explode(" ", $confirmation_time_lapse);

                    //  Join the values of the array above, using a coma (,)
                    $confirmation_time_lapse = implode(", ", $timeLapseArray);

                    //  Using this SQL statement, set the confirmation_status field of the record to 'Confirmed', and set the confirmation_time_lapse accordingly too
                    $sql = "UPDATE email_subscribers SET confirmation_status = 'Confirmed', confirmation_time_lapse = '" . $confirmation_time_lapse . "', subscription_status = 'Subscribed', date_unsubscribed = '-' WHERE confirmation_code = '" . mysqli_real_escape_string($conn, $confirmationCode) . "'";
                
                    //  Execute the query and let the subscriber know if 
                    //  the confirmation was successful or not
                    if (mysqli_query($conn, $sql)) {
                        $confirmationStatus = "Confirmed";
                    } else {
                        $confirmationStatus = "Error";
                    }

                //  But if the subscription has already been confirmed, 
                //  let the subscriber know too
                } else {
                    $confirmationStatus = "Already Confirmed";
                }
                
            } else {
                // We would have to redirect user to the subscription page
                header("location: http://localhost/uatwebsite/subscribe");
            }
            
        } else {

            header("location: http:/localhost/uatwebsite/index");
        }

    ?>

    <?php
        include "header.php";
    ?>

    <main>
        <section class="subscription-status-container">
            <div class="message">
                <?php   if ($confirmationStatus === "Confirmed") { ?>
                    
                            <div class="success-icon">
                                <i class="fa-sharp fa-solid fa-check-double icon"></i>
                            </div>                            
                            <h2 class="success">Subscription Confirmed!</h2>
                            <p> We have added your email address to our mailing list.
                                Whenever we release health updates, you can expect to have them sent directly to your inbox.</p>

                <?php   } else if ($confirmationStatus === "Already Confirmed") { ?> 

                            <div class="success-icon">
                                <i class="fa-sharp fa-solid fa-check-double icon"></i>
                            </div>
                            <h2 class="success">Already Confirmed!</h2>
                            <p> We have already added your email address to our mailing list. <br>
                                You will receive health updates whenever they are released.</p>  

                <?php   } else { ?>

                            <div class="error-icon">
                                <i class="fa-sharp fa-solid fa-xmark icon"></i>
                            </div>                            
                            <h2 class="error">Confirmation Error!</h2>
                            <p>An error occurred while trying to confirm your subscription.</p>  

                <?php   } ?>
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

