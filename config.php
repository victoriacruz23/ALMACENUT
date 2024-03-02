<?php

// instala cmd composer require google/apiclient
session_start();
require_once 'vendor/autoload.php';
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
//Set the OAuth 2.0 Client ID
$google_client->setClientId('302104777904-m4mjjhts2qltgr7ivvuggddcub28h2fr.apps.googleusercontent.com');
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/ALMACENUT/registro-google');
// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');
?> 