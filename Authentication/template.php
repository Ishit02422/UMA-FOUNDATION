<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Email Verification</title>
    <style>
        /* General reset */
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .email-container {
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px;
        }

        .header {
            background-color: #ffd700; /* Yellow background for header */
            padding: 20px;
        }

        .header img {
            width: 80px; /* Size of the logo */
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
        }

        .content p {
            color: #666666;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .content img {
            width: 150px; /* Adjusted image size for better display */
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            background-color: #000080; /* Dark blue button color */
            color: #ffffff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }

        .footer {
            background-color: #000080; /* Footer color */
            color: #ffffff;
            text-align: center;
            padding: 15px;
        }

        .footer p {
            margin: 0;
            font-size: 13px;
        }

    </style>
</head>
<body>

<div class='email-container'>
    <!-- Header with logo -->
    <div class='header'>
        <img src="https://i.imgur.com/aE79ffC.png" alt='Your Logo'> 
    </div>

    <!-- Main content -->
    <div class='content'>
        <h1>Welcome To Uma Foundation!</h1>
        <img src='https://i.imgur.com/6ZESHdN.jpg' alt='otp verify image'> 
        <p>We're excited to have you get started! First, you need to confirm your account. Please write the otp.</p>
        <p id='color'>$otp</p>
        <p>If you have any questions, please feel free to contact us. We're always ready to help out.</p>
        <p>Cheers,</p>
        <p>Uma Foundation</p>
    </div>

    <!-- Footer -->
    <div class='footer'>
        <p>Get In Touch</p>
    </div>
</div>

<script>
    // JavaScript function for button click action
    function confirmAccount() {
        // Placeholder function to demonstrate JavaScript integration
        alert('Your account has been confirmed!');
        // You can add further functionality here, like redirecting to a different page
    }
</script>

</body>
</html>