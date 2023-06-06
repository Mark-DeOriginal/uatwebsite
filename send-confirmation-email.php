<?php

    require 'vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $response = "";

    if (isset($_POST['fname']) && isset($_POST['email'])) {
        $subscriberFName = trim($_POST['fname']);
        $subscriberEmail = trim($_POST['email']);

        if ($subscriberFName === "" || $subscriberEmail === "") {
            $response = "One or more of the input fields appears empty. Please provide proper inputs in the respective fields.";
        
        } else if (filter_var($subscriberEmail, FILTER_VALIDATE_EMAIL) == false) {
            $response = "Your email address is invalid. Please provide a valid email address.";
        
        } else {

            //  Connect to the database
            require_once "database-connect.php";   

            $subscriberFName = mysqli_real_escape_string($conn, $subscriberFName);
            $subscriberEmail = mysqli_real_escape_string($conn, $subscriberEmail);
            
            //  If the request wasn't for us to "resend" the confirmation, then proceed with this block
            if (isset($_POST['resend-confirmation']) == false) {        

                $sql = "CREATE TABLE IF NOT EXISTS email_subscribers (
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    first_name VARCHAR(30) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    confirmation_code VARCHAR(100) NOT NULL,
                    subscription_date VARCHAR(30),
                    confirmation_status VARCHAR(30),
                    confirmation_time_lapse VARCHAR(30)
                )";

                mysqli_query($conn, $sql);

                $sql = "SELECT * FROM email_subscribers WHERE email = '" . $subscriberEmail. "' LIMIT 1";
                $result = mysqli_query($conn, $sql);

                //  If the email is in our subscribers list, carryout these extra checks
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    if ($row['confirmation_status'] === "Confirmed") {
                        $response = "Confirmed";
                    } else {
                        $response = "Not Confirmed";
                    }

                //  If there's no subscriber with such email, then we can add it
                } else {
                    try {

                        function generateCode() {
                            return bin2hex(random_bytes(16));
                        }
                        
                        $confirmationCode = generateCode(); 
                        $confirmationLink = 'http://localhost/uatwebsite/confirm-subscription.php?confirmation-code='. $confirmationCode;

                        $emailBody =  '<html>'
                                    . '<head>'
                                    . ' <style>
                                            h1 {
                                                color: #9b786d; 
                                                font-family: montserrat;
                                                font-size: 1.5em;
                                            }
                                            h2 {
                                                font-size: 1.3em;
                                                font-weight: 400;
                                            }
                                            p, a {
                                                font-size: 1.1em;
                                            }
                                            h2, p, a {
                                                font-family: poppins; 
                                                color: #626262;
                                            }                    
                                        </style>'
                                    . '</head>'
                                    . '<body>'
                                    . ' <h1>Confirm Subscription</h1>'
                                    . ' <h2>Hello, ' . $subscriberFName . '.</h2>' 
                                    . ' <p>We got your request to subscribe to our health updates.</p>'
                                    . ' <p>If ' . $subscriberEmail . ' is your correct email, please click on the confirmation link below to confirm your subscription.</p>'
                                    . ' <a href="'. $confirmationLink .'">'. $confirmationLink .'</a>'
                                    . '</body>'
                                    . '</html>';

                        $mail = new PHPMailer(true);

                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'davidmarkfriday16@gmail.com';
                        $mail->Password = 'scqgmmrblcansmvs';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;
                
                        $mail->setFrom('davidmarkfriday16@gmail.com', 'Mark Friday');
                        $mail->addAddress($subscriberEmail, $subscriberFName);
                        
                        $mail->isHTML(true);
                        $mail->Subject = 'Subscription';
                
                        $mail->Body = $emailBody;

                        if ($mail->send()) {
                            
                            $response = "Sent";

                            $subscription_date_TimeStamp = date("Y-m-d H:i:s A");
                
                            $sql = "INSERT INTO email_subscribers (first_name, email, confirmation_code, subscription_date, confirmation_status, confirmation_time_lapse)
                                    VALUES ('$subscriberFName', '$subscriberEmail', '$confirmationCode', '$subscription_date_TimeStamp', 'Not confirmed', '-')";
                
                            mysqli_query($conn, $sql);
                
                        } else {
                            $response = "The email was not sent. An error occurred. Please try again.";
                        }
                
                    } catch (Exception $e) {
                        $response = "Email not sent. Error: " . $e->getMessage();
                    }
                }

            //  Otherwise, proceed with this to resend the confirmation email
            } else {        
                try {

                    $sql = "SELECT * FROM email_subscribers WHERE email = '" . $subscriberEmail. "' LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    
                    $row = mysqli_fetch_assoc($result);

                    $confirmationCode = $row['confirmation_code'];
                    $confirmationLink = 'http://localhost/uatwebsite/confirm-subscription.php?confirmation-code='. $confirmationCode;
                
                    $emailBody =  '<html>'
                                    . '<head>'
                                    . ' <style>
                                            h1 {
                                                color: #9b786d; 
                                                font-family: montserrat;
                                                font-size: 1.5em;
                                            }
                                            h2 {
                                                font-size: 1.3em;
                                                font-weight: 400;
                                            }
                                            p, a {
                                                font-size: 1.1em;
                                            }
                                            h2, p, a {
                                                font-family: poppins; 
                                                color: #626262;
                                            }                    
                                        </style>'
                                    . '</head>'
                                    . '<body>'
                                    . ' <h1>Confirm Subscription</h1>'
                                    . ' <h2>Hello, ' . $row['first_name'] . '.</h2>' 
                                    . ' <p>We got your request to subscribe to our health updates.</p>'
                                    . ' <p>If ' . $subscriberEmail . ' is your correct email, please click on the confirmation link below to confirm your subscription.</p>'
                                    . ' <a href="'. $confirmationLink .'">'. $confirmationLink .'</a>'
                                    . '</body>'
                                    . '</html>';

                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'davidmarkfriday16@gmail.com';
                    $mail->Password = 'scqgmmrblcansmvs';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
            
                    $mail->setFrom('davidmarkfriday16@gmail.com', 'Mark Friday');
                    $mail->addAddress($subscriberEmail, $subscriberFName);
                    
                    $mail->isHTML(true);
                    $mail->Subject = 'Subscription';
            
                    $mail->Body = $emailBody;

                    if ($mail->send()) {
                        
                        $response = "Resent";
            
                    } else {
                        $response = "The email was not sent. An error occurred. Please try again.";
                    }
                } catch (Exception $e) {
                    $response = "Email not sent. Error: " . $e->getMessage();
                }
            }
        }
    }        

    header('Content-Type: text/plain');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    echo $response;
       
}
    
?>