<?php

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['confirmation-code'])) {
        
        $confirmationCode = $_GET['confirmation-code'];
        require_once "database-connect.php";

        $sql = "SELECT * FROM email_subscribers WHERE confirmation_code ='" . mysqli_real_escape_string($conn, $confirmationCode) . "' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {  

            $row = mysqli_fetch_assoc($result);

            $confirmationStatus = $row['confirmation_status'];

            if ($confirmationStatus !== "Confirmed") {
                $subscription_date_TimeStamp = $row['subscription_date'];
                $confirmation_date_TimeStamp = date("Y-m-d H:i:s A");
                
                $subscription_dateTime = DateTime::createFromFormat("Y-m-d H:i:s A", $subscription_date_TimeStamp);
                $confirmation_dateTime = DateTime::createFromFormat("Y-m-d H:i:s A", $confirmation_date_TimeStamp);

                $timeDifference = $subscription_dateTime->diff($confirmation_dateTime);
                
                $days = $timeDifference->days;
                $hours = $timeDifference->h;
                $minutes = $timeDifference->i;
                $seconds = $timeDifference->s;

                $confirmation_time_lapse = "";

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

                $timeLapseArray = explode(" ", $confirmation_time_lapse);

                $confirmation_time_lapse = implode(", ", $timeLapseArray);

                $sql = "UPDATE email_subscribers SET confirmation_status ='Confirmed', confirmation_time_lapse = '" . $confirmation_time_lapse . "' WHERE confirmation_code = '" . mysqli_real_escape_string($conn, $confirmationCode) . "'";
            
                if (mysqli_query($conn, $sql)) {
                    echo "<h1>Subscription Confirmation</h1>";
                    echo "<p>Your subscription has been confirmed successfully. It took you " . $confirmation_time_lapse . " before confirming your subscription.</p>";
                } else {
                    echo "<h1>Subscription Confirmation Error</h1>";
                    echo "<p>There was an error why confirming your subscription</p>";
                }

            } else {
                echo "<h1>Subscription Confirmed</h1>";
                echo "<p>Your subscription has already been confirmed.</p>";
            }
            
        } else {
            // We would have to redirect user to the subscription page
        }
        
    }
    
?>