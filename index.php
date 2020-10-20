<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Credentials: true');
}
require_once __DIR__ . '/vendor/autoload.php';
require_once "Common/Router.php";

