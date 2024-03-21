<?php

function generate_csrf_token()
{
    return bin2hex(random_bytes(32));
}

function set_csrf_token()
{
    $token = generate_csrf_token();
    $_SESSION['csrf_token'] = $token;
    return $token;
}
function validateToken($Tokenpost,$TokenSession)
{
    if (isset($Tokenpost) && isset($TokenSession)) {
        $sent_token = $Tokenpost;
        $stored_token = $TokenSession;

        if ($sent_token === $stored_token) {
           return true;
        } else {
           return false;
        }
    } else {
        return false;
    }
}

