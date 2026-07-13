<?php 
require 'send_email_brevo.php';

$otp = random_int(10000, 99999);

$result = sendEmailBrevo(
    'naishal036@gmail.com',
    '',
    'OTP for Login',
    'login for otp is ' . $otp,
    'The login otp is for clients registering on system'
);

?>
