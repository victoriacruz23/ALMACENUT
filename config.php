<?php
require_once 'vendor/autoload.php';
// instala cmd composer require google/apiclient
function initGoogleClient($clientId, $clientSecret, $redirectUri) {
    //Make object of Google API Client for call Google API
    $google_client = new Google_Client();
    //Set the OAuth 2.0 Client ID
    $google_client->setClientId($clientId);
    //Set the OAuth 2.0 Client Secret key
    $google_client->setClientSecret($clientSecret);
    //Set the OAuth 2.0 Redirect URI
    $google_client->setRedirectUri($redirectUri);
    // to get the email and profile 
    $google_client->addScope('email');
    $google_client->addScope('profile');

    return $google_client;
}

// Configuración para el primer lugar registro.php y register.php
$google_client1 = initGoogleClient('302104777904-m4mjjhts2qltgr7ivvuggddcub28h2fr.apps.googleusercontent.com', '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', 'https://almacenuta.com');

// Configuración para el segundo lugar
$google_client2 = initGoogleClient('302104777904-m4mjjhts2qltgr7ivvuggddcub28h2fr.apps.googleusercontent.com', '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', 'https://almacenuta.com/inicio-sesion-google');