<?php 
    include "get-contact-info.php";
?>
<div class="column contact-us">
    <h4>Contact us</h4>
    <p><?php echo $contact_info['address']; ?></p>
    <p><a href="https://wa.me/<?php echo str_replace(array('(', ')', '+', ' '), '', $contact_info['phone_number']); ?>"><i class="fab fa-whatsapp"></i><?php echo $contact_info['phone_number']; ?></p></a>
    <p><a href="mailto:<?php echo $contact_info['email']; ?>"><i class="fa-regular fa-envelope"></i><?php echo $contact_info['email']; ?></a></p>
    <div class="socials">
        <a href="<?php echo $contact_info['facebook_link']; ?>"><i class="fab fa-facebook"></i></a>
        <a href="<?php echo $contact_info['twitter_link']; ?>"><i class="fab fa-twitter"></i></a>
        <a href="<?php echo $contact_info['instagram_link']; ?>"><i class="fab fa-instagram"></i></a>
        <a href="<?php echo $contact_info['tiktok_link']; ?>"><i class="fab fa-tiktok"></i></a>
        <a href="<?php echo $contact_info['linkedin_link']; ?>"><i class="fab fa-linkedin"></i></a>
    </div>
</div>

<?php 
    mysqli_close($conn);
?>