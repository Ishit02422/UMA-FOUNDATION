<?php 
require 'send_email_brevo.php';

$otp = random_int(10000, 99999);

$toEmail = $_POST['email'] ?? '';

$htmlBody = '<h2>Uma Foundation - Account Recovery</h2>'
          . '<p>Your password reset OTP is:</p>'
          . '<h1 style="color:#000080;letter-spacing:5px;">' . $otp . '</h1>'
          . '<p>This OTP is valid for 10 minutes.</p>'
          . '<p>Uma Foundation Team</p>';

$result = sendEmailBrevo(
    $toEmail,
    '',
    'OTP for Account Recovery - Uma Foundation',
    $htmlBody,
    'Your Uma Foundation account recovery OTP is: ' . $otp
);

if ($result['success']) {
    echo $otp;
} else {
    echo "ERROR: " . $result['error'];
}
?>
