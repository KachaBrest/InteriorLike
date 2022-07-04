<?php
session_start();

$responseJson = file_get_contents('php://input');
$response = json_decode($responseJson, true);

$id = $response['id'];

unset($_SESSION['src']["$id"]);

