<?php

    require 'vendor/autoload.php';
    require_once "config.php";

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

            //  Get and store the company info, like, address, phone number, etc.
            $getCompanyInfo = "SELECT * FROM contact_information WHERE Id= '1' LIMIT 1";
            $companyInfo = mysqli_fetch_assoc(mysqli_query($conn, $getCompanyInfo));

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
                    confirmation_time_lapse VARCHAR(30),
                    subscription_status VARCHAR(30),
                    date_unsubscribed VARCHAR(30)
                )";

                mysqli_query($conn, $sql);

                $sql = "SELECT * FROM email_subscribers WHERE email = '" . $subscriberEmail. "' LIMIT 1";
                $result = mysqli_query($conn, $sql);

                //  If the email is in our subscribers list, carryout these extra checks
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    if ($row['confirmation_status'] === "Confirmed" && $row['subscription_status'] === "Subscribed") {
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
                        $confirmationLink = 'http://localhost/uatwebsite/confirm/'. $confirmationCode;

                        $unsubscribeLink = 'http://localhost/uatwebsite/unsubscribe/'. $confirmationCode;
                        
                        $emailBody = file_get_contents("confirmation-email-template.php");
                        
                        $search = array('{{SUBSCRIBER_NAME}}', '{{SUBSCRIBER_EMAIL}}', '{{CONFIRMATION_LINK}}', '{{UNSUBSCRIPTION_LINK}}', '{{COMPANY_ADDRESS}}', '{{COMPANY_PHONE}}');
                        $replaceWith = array($subscriberFName, $subscriberEmail, $confirmationLink, $unsubscribeLink, $companyInfo['address'], $companyInfo['phone_number']);
    
                        $emailBody = str_replace($search, $replaceWith, $emailBody);

                        $mail = new PHPMailer(true);

                        $mail->isSMTP();
                        $mail->Host = 'smtp-relay.brevo.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = smtp_username;
                        $mail->Password = smtp_password;
                        $mail->SMTPSecure = 'tls';
                        $mail->CharSet = 'UTF-8';
                        $mail->Port = 587;
                
                        $mail->addCustomHeader('List-Unsubscribe', '<' . $unsubscribeLink . '>');
                        $mail->setFrom('info@uat-wellness.com', 'Uju Alternative Therapies');
                        $mail->addAddress($subscriberEmail, $subscriberFName);
                        
                        $mail->isHTML(true);
                        $mail->Subject = 'Confirm Subscription';
                
                        $mail->Body = $emailBody;

                        if ($mail->send()) {
                            
                            $response = "Sent";

                            $subscription_date_TimeStamp = date("Y-m-d H:i:s A");
                
                            $sql = "INSERT INTO email_subscribers (first_name, email, confirmation_code, subscription_date, confirmation_status, confirmation_time_lapse, subscription_status, date_unsubscribed)
                                    VALUES ('$subscriberFName', '$subscriberEmail', '$confirmationCode', '$subscription_date_TimeStamp', 'Not Confirmed', '-', 'Not Subscribed', '-')";
                
                            mysqli_query($conn, $sql);
                
                        } else {
                            $response = "Request failed. An error occurred. Please try again.";
                        }
                
                    } catch (Exception $e) {
                        $response = "An error occurred while sending the email. Error info: " . $e;
                    }
                }

            //  Otherwise, proceed with this to resend the confirmation email
            } else {        
                try {

                    $sql = "SELECT * FROM email_subscribers WHERE email = '" . $subscriberEmail. "' LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    
                    $row = mysqli_fetch_assoc($result);

                    $confirmationCode = $row['confirmation_code'];
                    $confirmationLink = 'http://localhost/uatwebsite/confirm/'. $confirmationCode;
                
                    $unsubscribeLink = 'http://localhost/uatwebsite/unsubscribe/'. $confirmationCode;

                    $emailBody =  file_get_contents("confirmation-email-template.php");

                    $search = array('{{SUBSCRIBER_NAME}}', '{{SUBSCRIBER_EMAIL}}', '{{CONFIRMATION_LINK}}', '{{UNSUBSCRIPTION_LINK}}', '{{COMPANY_ADDRESS}}', '{{COMPANY_PHONE}}');
                    $replaceWith = array($subscriberFName, $subscriberEmail, $confirmationLink, $unsubscribeLink, $companyInfo['address'], $companyInfo['phone_number']);

                    $emailBody = str_replace($search, $replaceWith, $emailBody);
                    
                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp-relay.brevo.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = smtp_username;
                    $mail->Password = smtp_password;
                    $mail->SMTPSecure = 'tls';
                    $mail->CharSet = 'UTF-8';
                    $mail->Port = 587;
            
                    $mail->addCustomHeader('List-Unsubscribe', '<' . $unsubscribeLink . '>');
                    $mail->setFrom('info@uat-wellness.com', 'Uju Alternative Therapies');
                    $mail->addAddress($subscriberEmail, $subscriberFName);

                    $mail->isHTML(true);
                    $mail->Subject = 'Confirm Subscription';
            
                    $mail->Body = $emailBody;

                    if ($mail->send()) {
                        
                        $response = "Resent";
            
                    } else {
                        $response = "The email was not sent. An error occurred. Please try again.";
                    }
                    
                } catch (Exception $e) {
                    $response = "An error occurred while sending the email. Error info: " . $e;
                }
            }
        }
    }
    
    mysqli_close($conn);

    header('Content-Type: text/plain');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    echo $response;
       
} else {

    header("location: index.php");
}
    
?>