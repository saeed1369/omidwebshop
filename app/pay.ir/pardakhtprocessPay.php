<?php

include_once("functions.php");
$api = 'test';
$amount = "500000";
if(isset($_GET["sum"]))
	$amount = $_GET["sum"];
$mobile = "09170536465";
$factorNumber = "FactorNumber (optional)";
$description = "Description (optional)";
$redirect = 'http://localhost/moasseseh_hoghoughi/lib/pardakhtprocess2Pay.php';
//$result = send($api, $amount, $redirect, $mobile, $factorNumber, $description);
$result = send($api, $amount, $redirect, $mobile);
$result = json_decode($result);
if($result->status) {
	$go = "https://pay.ir/pg/$result->token";
	header("Location: $go");
} else {
		$_SESSION['result_pardakht']= $result->errorMessage;
		header("Location:../moshavereh.php");
}