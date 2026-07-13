<?php 
require 'send_email_brevo.php';

$otp = random_int(10000, 99999);

$toEmail = $_POST['email'] ?? '';

$htmlBody = '<h2>Uma Foundation - OTP Verification</h2>'
          . '<p>Your OTP code is:</p>'
          . '<h1 style="color:#000080;letter-spacing:5px;">' . $otp . '</h1>'
          . '<p>This OTP is valid for 10 minutes.</p>'
          . '<p>Uma Foundation Team</p>';

$result = sendEmailBrevo(
    $toEmail,
    '',
    'OTP for Login - Uma Foundation',
    $htmlBody,
    'Your Uma Foundation OTP is: ' . $otp
);

if ($result['success']) {
    echo $otp;
} else {
    echo "ERROR: " . $result['error'];
}
?>
