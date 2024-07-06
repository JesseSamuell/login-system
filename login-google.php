<?php
require 'vendor/autoload.php';
require 'db.php';

use League\OAuth2\Client\Provider\Google;

session_start();

$provider = new Google([
    'clientId'     => 'YOUR_GOOGLE_CLIENT_ID',
    'clientSecret' => 'YOUR_GOOGLE_CLIENT_SECRET',
    'redirectUri'  => 'http://localhost/login-system/google-callback.php',
]);

if (!isset($_GET['code'])) {
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    try {
        $user = $provider->getResourceOwner($token);
        $email = $user->getEmail();
        
        // Check if user exists
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        if ($stmt->num_rows == 0) {
            // Register new user
            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, '')");
            $stmt->bind_param("s", $email);
            $stmt->execute();
        }
        
        $_SESSION['user'] = $email;
        header('Location: dashboard.php');
    } catch (Exception $e) {
        exit('Failed to get user details');
    }
}
?>
