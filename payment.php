<?php 
require('razorpay-php-2.9.0/Razorpay.php');
use Razorpay\Api\Api;

$api = new Api('rzp_test_qxeuAYL6jOqDSW', 'IxoRKz8mHWNvDpWmN5n74wpI');
$orderData = [
    'receipt'         => 'order_rcptid_11',
    'amount'          => 50000, // amount in the smallest currency unit (e.g., 50000 paise = ₹500)
    'currency'        => 'INR',
    'payment_capture' => 1 // auto-capture payment after authorization
];

$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];

?>
<html>
    <head>
        <style>
            body{
                background-image: url('test1/assets/images/meetings-bg.jpg');
            };
            </style>
            
</head>
<body>
    

<form action="verifypayment.php" method="POST">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_test_qxeuAYL6jOqDSW"
        data-amount="50000" // amount in the smallest currency unit
        data-currency="INR"
        data-order_id="<?php echo $razorpayOrderId; ?>"
        data-buttontext="Pay with Razorpay"
        data-name="uma Foundation"
        data-description="Test Transaction"
        data-image="background1.jpg"
        data-prefill.name="Gaurav Kumar"
        data-prefill.email="gaurav.kumar@example.com"
        data-prefill.contact="9999999999"
        data-theme.color="#2986cc"
    ></script>
    <input type="hidden" name="hidden">
</form>
</body>
</html>