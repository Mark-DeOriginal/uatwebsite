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

            .email-content {
                max-width: 590px;
                margin: 0 auto;
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
            }
            p:not(:nth-of-type(1)) {
                margin-top: 10px;
            }
            p, a {
                font-size: 1.1em;
            }
            h2, p, a {
                color: #626262;
            }
            .header {
                padding: 20px;
                border-bottom: 2px solid #ede6e6;
                display: flex;
                align-items: center;
                justify-content: center;
                max-width: 400px;
                margin: 0 auto 20px auto;
            }
            .logo {
                width: 180px;
                height: auto;
                margin: 0 auto;
            }
            a.button {
                display: block;
                width: fit-content;
                padding: 10px 20px;
                border-radius: 10px;
                border: none;
                background-color: #f1e7e7;
                color: #7a5e53;
                margin: 20px 0 20px 0;
                font-size: 1.1em;
                cursor: pointer;
                transition: 0.3s;
            }
            a.button:hover {
                background-color: #ede0e0;
            }
            a.button:active {
                transform: scale(0.95);
            }
            a.link {
                color: #9b786d;
                text-decoration: underline;
            }
            .email-footer {
                max-width: 500px;
                margin: 50px auto 0 auto;
                border-top: 2px solid #ede6e6;
                padding: 0 20px 0 20px;          
            }
            p.small-text {
                font-size: 0.9em;
                text-align: center;
            }
                               
        </style>
    </head>
    <body>
        <div class="email-content">
            <div class="header">
                <img src="https://drive.google.com/uc?id=1yTKjvGOrpmRdXxJwomVIBAfWrw7co8xy" class="logo">
            </div>
            <h1>Confirm Subscription</h1>
            <p>Hello, {{SUBSCRIBER_NAME}}.</p>
            <p>We got your request to subscribe to our health updates. We are happy to have you join our community of wellness enthusiasts who are dedicated to exploring the healing power of natural and alternative therapies.</p>
            <p>To complete the subscription process and ensure you receive our valuable content, simply click on the button below to confirm your subscription:</p>
            <a href="{{CONFIRMATION_LINK}}" class="button">Confirm Subscription</a>
            <div class="email-footer">
                <p class="small-text">If you didn't subscribe to our health updates or you're not sure why you received this email, you can disregard it.</p>
                <p class="small-text">For questions or any enquiry, kindly reach out to us: <br>
                   <strong>Uju Alternative Therapies</strong><br>
                   #29 Maxwell Street, Trademore Estate, Lugbe - Abuja, Nigeria.<br>
                   (+234) 812 1277 401</p>
            </div>
            
        </div>
    </body>
</html>