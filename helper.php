<?php

use \Firebase\JWT\JWT;

function response($message) {
    return print_r($message);
}

function createJWT($payload) {
    $key = "primerparcial";
    return JWT::encode($payload, $key);
}

function validatorJWT($jwt) {
    try {
        $key = "primerparcial";
        return JWT::decode($jwt, $key, array('HS256'));
    } catch(\Exception $e) {
        echo 'Error', ". Please login again. ";
    }
}