<?php 
require('razorpay-php-2.9.0/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\Error;

$api = new Api('rzp_test_qxeuAYL6jOqDSW', 'IxoRKz8mHWNvDpWmN5n74wpI');

$attributes = array(
    'razorpay_order_id' => $_POST['razorpay_order_id'],
    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
    'razorpay_signature' => $_POST['razorpay_signature']
);

try {
    $api->utility->verifyPaymentSignature($attributes);
    // Payment successful, update your database
    echo "Payment successful!";
    echo $_POST['razorpay_payment_id'];
    
} catch(Error $e) {
    // Payment failed
    echo "Payment failed! ".$e;
}

?>