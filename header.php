<header>        
    <div class="flex1">
        <!-- Logo Section -->
        <div class="logo">
            <a href="index">
                <img src="resources/images/uat-logo-svg.svg" alt="UAT Logo">
            </a>
        </div>

        <!-- This holds our Appointment Button and Hamburger Menu -->
        <div class="hamburger-and-button">
            <a href="#" class="book-appointment">Book Appointment</a>
            
            <!-- Hamburger Menu for smaller screen devices -->
            <div class="hamburger-menu">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
    </div>

    <div class="flex2">
        <!-- Header Navigation Bar Section -->
        <nav class="nav-bar">
            <!-- This Bottom Bar will move to the active or currently hovered Nav Item -->
            <div class="bottom-bar"></div>
            <ul>
                <li>
                    <a href="home" class="<?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'?>">Home</a>
                </li>
                <li>
                    <a href="about-us" class="<?php if (basename($_SERVER['PHP_SELF']) == 'about-us.php') echo 'active'?>">About</a>
                </li>
                <li>
                    <a href="briefs" class="<?php if (basename($_SERVER['PHP_SELF']) == 'briefs.php') echo 'active'?>">Briefs</a>
                </li>
                <li>
                    <a href="testimonials" class="<?php if (basename($_SERVER['PHP_SELF']) == 'testimonials.php') echo 'active'?>">Testimonials</a>
                </li>
                <li>
                    <a href="faq" class="<?php if (basename($_SERVER['PHP_SELF']) == 'faq.php') echo 'active'?>">FAQ</a>
                </li>
                <li>
                    <a href="contact-us" class="<?php if (basename($_SERVER['PHP_SELF']) == 'contact-us.php') echo 'active'?>">Contact us</a>
                </li>
                <li>
                    <a href="book-appointment" class="book-appointment">Book Appointment</a>
                </li>                
            </ul>            
        </nav>
    </div>        
</header>