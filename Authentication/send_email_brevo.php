<?php
function sendEmailBrevo($toEmail, $toName, $subject, $htmlBody, $textBody = '') {
    $apiKey = trim(getenv('BREVO_API_KEY') ?: '');
    $apiKey = trim($apiKey, "\"'"); // Strip single/double quotes
    
    if ($apiKey === '') {
        return ['success' => false, 'error' => 'BREVO_API_KEY not set'];
    }

    $senderEmail = trim(getenv('BREVO_SENDER_EMAIL') ?: '22bmiit022@gmail.com');
    $senderEmail = trim($senderEmail, "\"'"); // Strip single/double quotes
    
    $senderName  = trim(getenv('BREVO_SENDER_NAME')  ?: 'Uma Foundation');
    $senderName  = trim($senderName, "\"'"); // Strip single/double quotes
    
    $toEmail = trim($toEmail, "\"' \t\n\r\0\x0B"); // Strip quotes and whitespaces
    $toName = trim($toName, "\"' \t\n\r\0\x0B");

    // Build JSON payload
    $payload = json_encode([
        'sender'      => ['name' => $senderName, 'email' => $senderEmail],
        'to'          => [['email' => $toEmail, 'name' => $toName ?: $toEmail]],
        'subject'     => $subject,
        'textContent' => $textBody ?: ('Your OTP is: ' . strip_tags($htmlBody)),
        'htmlContent' => $htmlBody,
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    if ($payload === false) {
        return ['success' => false, 'error' => 'JSON encode failed: ' . json_last_error_msg()];
    }

    $ch = curl_init('https://api.brevo.com/v3/smtp/email');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'accept: application/json',
            'api-key: ' . $apiKey,
            'content-type: application/json',
            'Content-Length: ' . strlen($payload),
        ],
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => true,
    ]);

    $response  = curl_exec($ch);
    $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return ['success' => false, 'error' => 'cURL: ' . $curlError];
    }

    $res = json_decode($response, true);
    if ($httpCode >= 200 && $httpCode < 300) {
        return ['success' => true];
    }
    return ['success' => false, 'error' => "HTTP $httpCode: " . ($res['message'] ?? $response) . " (Payload: $payload)"];
}
?>
