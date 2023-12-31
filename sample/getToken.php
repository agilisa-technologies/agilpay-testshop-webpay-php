<?php
// API endpoint and request JWT access token
$api_url = 'https://sandbox-webapi.agilpay.net/oauth/paymenttoken';
// replace with your client_id and client_secret
$client_id = 'API-001';  
$client_secret = 'Dynapay';
// customer order number, same as Detail.Service  
$orderId = 'ABC12345';  
// customer account number
$customerId = 'User-123456';  
// order total amount
$amount = '123.55'; 

// Prepare the request data
$request_data = [
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'orderId' => $orderId,
    'customerId' => $customerId,
    'amount' => $amount,
];

// Initialize cURL session for token request
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session for token request
$response = curl_exec($ch);

// Check for errors in obtaining token
if ($response === false) {
    echo 'Error: Unable to get Access Token.';
} else {
    // Decode JSON response
    $decoded_response = json_decode($response, true);

    // Check if access_token is present in response
    if (isset($decoded_response['access_token'])) {
        // Output access token
        echo $decoded_response['access_token'];
    } else {
        echo 'Access Token not found in the response.';
    }
}

// Close cURL session for token request
curl_close($ch);
?>
