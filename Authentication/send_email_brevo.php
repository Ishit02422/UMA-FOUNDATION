<?php
/**
 * Brevo (formerly Sendinblue) HTTP API Email Sender
 * This replaces PHPMailer SMTP which is blocked on Render free tier.
 * 
 * Required: Set BREVO_API_KEY environment variable on Render
 * Get your free API key from: https://app.brevo.com/settings/keys/api
 * 
 * Free tier: 300 emails/day
 */

function sendEmailBrevo($toEmail, $toName, $subject, $htmlBody, $textBody = '') {
    // API key from Render environment variable
    $apiKey = getenv('BREVO_API_KEY');
    if (!$apiKey || $apiKey === '') {
        return ['success' => false, 'error' => 'BREVO_API_KEY not set in environment'];
    }

    // Sender details
    $senderEmail = getenv('BREVO_SENDER_EMAIL') ?: '22bmiit022@gmail.com';
    $senderName  = getenv('BREVO_SENDER_NAME') ?: 'Uma Foundation';
    
    $data = [
        'sender' => [
            'name'  => $senderName,
            'email' => $senderEmail
        ],
        'to' => [
            [
                'email' => $toEmail,
                'name'  => $toName ?: $toEmail
            ]
        ],
        'subject'     => $subject,
        'htmlContent' => $htmlBody,
    ];
    
    if ($textBody) {
        $data['textContent'] = $textBody;
    }
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => 'https://api.brevo.com/v3/smtp/email',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($data),
        CURLOPT_HTTPHEADER     => [
            'accept: application/json',
            'api-key: ' . $apiKey,
            'content-type: application/json'
        ],
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => true,
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    if ($curlError) {
        return ['success' => false, 'error' => 'cURL error: ' . $curlError];
    }
    
    $responseData = json_decode($response, true);
    
    if ($httpCode >= 200 && $httpCode < 300) {
        return ['success' => true, 'messageId' => $responseData['messageId'] ?? ''];
    } else {
        $errorMsg = $responseData['message'] ?? $response;
        return ['success' => false, 'error' => "HTTP $httpCode: $errorMsg"];
    }
}
?>
