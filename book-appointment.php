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
            <div class="container <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) echo 'submitted';?>">
                <?php

                    //  Load required resources
                    require 'vendor/autoload.php';
                    require_once "config.php";

                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

                    //  Proceed with this if the form is submitted
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) { 
                        $fullname = trim($_POST['full-name']);
                        $email = trim($_POST['email']);
                        $phone = trim($_POST['phone']);
                        $appointmentType = trim($_POST['appointment-type']);
                        $appointmentDate = trim($_POST['appmnt-date']);
                        $optionalMessage = trim($_POST['message']);

                        // Will return true or false if the reference file is uploaded or not
                        $isRelevantDocUploaded = isset($_FILES['relevant-doc']) && $_FILES['relevant-doc']['error'] == UPLOAD_ERR_OK ? true : false;
                        $isPaymentReceiptUploaded = isset($_FILES['payment-receipt']) && $_FILES['payment-receipt']['error'] == UPLOAD_ERR_OK ? true : false;       
                
                        if (!empty($fullname) && !empty($email) && !empty($phone) && !empty($appointmentType) && !empty($appointmentDate)) {

                            require_once "database-connect.php";

                            $sql = "CREATE TABLE IF NOT EXISTS appointments(
                                Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                fullname VARCHAR(100) NOT NULL,
                                email VARCHAR(100) NOT NULL,
                                phone VARCHAR(20) NOT NULL,
                                appointment_type VARCHAR(20) NOT NULL,
                                appointment_date VARCHAR(20) NOT NULL,
                                optional_message VARCHAR(6000),
                                booked_date VARCHAR(30)
                            )";

                            mysqli_query($conn, $sql);

                            $fullname = mysqli_real_escape_string($conn, $fullname);
                            $email = mysqli_real_escape_string($conn, $email);
                            $phone = mysqli_real_escape_string($conn, $phone);
                            $appointmentType = mysqli_real_escape_string($conn, $appointmentType);
                            $appointmentDate = mysqli_real_escape_string($conn, $appointmentDate);
                            $optionalMessage = mysqli_real_escape_string($conn, $optionalMessage);
                            $optionalMessage = !empty(trim($optionalMessage)) ? $optionalMessage : "No message provided";

                            $bookedDate = date("Y:m:d H:i:s A");

                            $sql = "INSERT INTO appointments(
                                        fullname,
                                        email, 
                                        phone, 
                                        appointment_type, 
                                        appointment_date,
                                        optional_message,
                                        booked_date
                                    ) VALUES (
                                        '$fullname',
                                        '$email',
                                        '$phone',
                                        '$appointmentType',
                                        '$appointmentDate',
                                        '$optionalMessage',
                                        '$bookedDate'
                                    )";

                            mysqli_query($conn, $sql);

                            $fileUploaded = "";

                            function moveUploadedFile($fullFileName, $filePath, $fileCategory) {                                

                                global $fullname;
                                $bookersName = implode('-', explode(' ', strtolower($fullname)));

                                $fullNameOfFile = explode('.', $fullFileName);
                                $fileExtension = array_pop($fullNameOfFile);

                                array_pop($fullNameOfFile);

                                $fileName = implode('-', $fullNameOfFile);
                                $fileName = str_replace(' ', '-', $fileName);

                                $fileName = $bookersName . '-' . $fileName . $fileCategory . uniqid();

                                $fullFileName = $fileName . '.' . $fileExtension;

                                $tempPathName = $filePath;
                                $fullFilePath = 'user-uploads/' . $fullFileName;

                                move_uploaded_file($tempPathName, $fullFilePath);

                                global $fileUploaded;

                                $fileUploaded = $fullFilePath;
                            }

                            if ($isRelevantDocUploaded) {
                                moveUploadedFile($_FILES["relevant-doc"]["name"], $_FILES['relevant-doc']['tmp_name'], "-relevant-doc-");
                                $relevantDocUploaded = $fileUploaded;
                            }

                            if ($isPaymentReceiptUploaded) {
                                moveUploadedFile($_FILES["payment-receipt"]["name"], $_FILES['payment-receipt']['tmp_name'], "-payment-receipt-");
                                $paymentReceiptUploaded = $fileUploaded;
                            }

                            $emailBody = file_get_contents("new-appointment-notification-template.php");
                            
                            $search = array('{{FULL_NAME}}', '{{PHONE}}', '{{EMAIL}}', '{{APPOINTMENT_TYPE}}', '{{APPOINTMENT_DATE}}', '{{MESSAGE}}');
                            $replaceWith = array($fullname, $phone, $email, $appointmentType, $appointmentDate, $optionalMessage);
        
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
                    
                            $mail->setFrom('info@uat-wellness.com', 'Uju Alternative Therapies');
                            $mail->addAddress('info@uat-wellness.com', 'Uju Alternative Therapies');
                            $mail->addAddress('ujualternativetherapies@gmail.com', 'Uju Alternative Therapies');
                            $mail->addAddress('davidmarkfriday16@gmail.com', 'Mark Friday');
                            
                            $mail->isHTML(true);
                            $mail->Subject = 'New Appointment';

                            if ($isRelevantDocUploaded) {
                                $mail->addAttachment($relevantDocUploaded, "relevant-doc");
                            }

                            if ($isPaymentReceiptUploaded) {
                                $mail->addAttachment($paymentReceiptUploaded, "payment-receipt");
                            }
                    
                            $mail->Body = $emailBody;

                            $mail->send();

                            $mail = new PHPMailer(true);

                            $mail->isSMTP();
                            $mail->Host = 'smtp-relay.brevo.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = smtp_username;
                            $mail->Password = smtp_password;
                            $mail->SMTPSecure = 'tls';
                            $mail->CharSet = 'UTF-8';
                            $mail->Port = 587;
                    
                            $mail->setFrom('info@uat-wellness.com', 'Uju Alternative Therapies');
                            $mail->addAddress($email, $fullname);
                            
                            $mail->isHTML(true);
                            $mail->Subject = 'Appointment Booked Successfully';                            
                    
                            $emailBody = file_get_contents("appointment-confirmation-template.php");
                            
                            $search = array('{{FULL_NAME}}', '{{PHONE}}', '{{EMAIL}}', '{{APPOINTMENT_TYPE}}', '{{APPOINTMENT_DATE}}', '{{MESSAGE}}');
                            $replaceWith = array($fullname, $phone, $email, $appointmentType, $appointmentDate, $optionalMessage);
        
                            $emailBody = str_replace($search, $replaceWith, $emailBody);

                            $mail->Body = $emailBody;

                            $mail->send(); ?>

                            <div class="success-icon">
                                <i class="fa-sharp fa-solid fa-check-double icon"></i>
                            </div>
                            <h2 class="success">Appointment Booked Successfully!</h2>
                            <p> Your appointment has been submitted. We'll get in touch with you soon, via Phone or email.</p>
                        
                <?php   } else { ?>
                            <div class="error-icon">
                                <i class="fa-sharp fa-solid fa-xmark icon"></i>
                            </div>                            
                            <h2 class="error">Form Validation Error!</h2>
                            <p>One or more required fields appears empty, so the form could not be submitted. Please fill the form completely, before submitting.</p> 
                <?php
                        }
                
                            

                
                    } else { ?>

                        <form method="POST" action="<?php echo explode(".", $_SERVER['PHP_SELF'])[0]?>" enctype="multipart/form-data">
                            <input type="text" name="full-name" placeholder="Full name" id="full-name" class="text-input" required>
                            <input type="text" name="email" placeholder="Email address" id="email" class="text-input" required>
                            <input type="text" name="phone" placeholder="Phone number" id="phone" class="text-input" required>
                            <input type="hidden" value="" name="appointment-type" class="appointment-type-choice">
                            <div class="appointment-type-wrapper">
                                <div class="appointment-type dropdown-btn">
                                    <p class="choice">Appointment type</p>
                                    <div class="toggle-icon">
                                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                                <div class="dropdown list">
                                    <ul>
                                        <li>Appointment type...</li>
                                        <li>Physical</li>
                                        <li>Online</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="appointment-date-wrapper">
                                <label for="appmnt-date">Appointment date</label>
                                <input type="date" name="appmnt-date" id="appmnt-date" required>
                            </div>
                            <div class="upload-wrapper">
                                <p>Upload relevant document</p>
                                <p class="info">Example: test result, medical history, etc. (Optional)</p>
                                <button type="button" class="choose-file-btn">Upload file</button>
                                <div class="files-wrapper">
                                    <div class="file hidden">
                                        <div class="file-name">
                                            <input type="file" name="relevant-doc" class="uploader relevant-doc" accept=".jpg, .png, .pdf, .docx">
                                        </div>                                
                                        <i class="delete-file-icon">&times;</i>
                                    </div>
                                </div>
                            </div> 
                            <textarea name="message" placeholder="Message (Optional)" class="message"></textarea>
                            <div class="pricing-area">
                                <div class="header">
                                    <h4>Please note</h4>
                                </div>
                                <div class="body">
                                    <div class="price-list">
                                        <p>Appointment Fee: ₦10,000</p>
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
                                    <input type="file" name="payment-receipt" class="uploader payment-receipt" accept=".jpg, .png, .pdf, .docx">
                                </div>
                            </div>
                            <div class="validation-error">
                                
                            </div>
                            <input type="submit" value="Book appointment" name="submit" class="book-appointment-btn">
                        </form>
                <?php
                    }
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