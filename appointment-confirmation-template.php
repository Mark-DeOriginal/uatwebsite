<html>
    <head>
        <style>
            * {
                box-sizing: border-box;                
                text-decoration: none;
                font-family: 'Tahoma', sans-serif;
            }
            body {
                margin: 0;
                padding: 20px;
            }
            h1 {
                color: #9b786d; 
                font-size: 1.7em;
                font-weight: 600;
                margin: 0 0 20px 0;
                text-align: center;
            }
            P {
                line-height: 1.6em;
                color: #626262;
                margin: 0;
            }
        
            p, a {
                font-size: 1.1em;
            }
            h2, p, a {
                color: #626262;
            }
            .header {
                padding: 20px;
                max-width: 400px;
                margin: 0 auto 20px auto;
            }
            .header-text {
                margin-top: 40px;
                text-align: center;
            }
            
            img.logo {
                width: 180px;
                height: auto;
                display: block;
                margin: 0 auto;
            }

            .email-content .appointment-details {
                background-color: #f5f1f1;
                border-radius: 10px;
            }

            .email-content .appointment-details .row {
                padding: 10px 20px;
            }

            .email-content .appointment-details .row {
                padding: 10px 20px;
            }

            .email-content .appointment-details .row p.text-heading {
                font-size: 1em;
                color: #9b9191;
            }
            .email-content .appointment-details .row p.text-description {
                margin-top: 5px;
            }
            .email-content .appointment-details .row.border-bottom {
                border-bottom: 1px solid #e9e2e2;
            }
                               
        </style>
    </head>
    <body>
        <div class="email-content">
            <div class="header">                
                <img src="https://drive.google.com/uc?id=1yTKjvGOrpmRdXxJwomVIBAfWrw7co8xy" class="logo">
                
                <div class="header-text">
                    <h1>Appointment Booked Successfully</h1>
                    <p class="text-description">We'll get in touch with you soon. <br>Below are the details you provided.</p>
                </div>
            </div>
            <div class="appointment-details">
                <div class="row border-bottom">
                    <p class="text-heading">Name</p>
                    <p class="text-description">{{FULL_NAME}}</p>
                </div>
                <div class="row border-bottom">
                    <p class="text-heading">Phone</p>
                    <p class="text-description">{{PHONE}}</p>
                </div>
                <div class="row border-bottom">
                    <p class="text-heading">Email</p>
                    <p class="text-description">{{EMAIL}}</p>
                </div>
                <div class="row border-bottom">
                    <p class="text-heading">Appointment type</p>
                    <p class="text-description">{{APPOINTMENT_TYPE}}</p>
                </div>
                <div class="row border-bottom">
                    <p class="text-heading">Appointment date</p>
                    <p class="text-description">{{APPOINTMENT_DATE}}</p>
                </div>
                <div class="row">
                    <p class="text-heading">Message</p>
                    <p class="text-description">{{MESSAGE}}</p>
                </div>
            </div>
            
        </div>
    </body>
</html>