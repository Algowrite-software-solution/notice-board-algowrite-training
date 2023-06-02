<?php

session_start();

require("../app/dbQuery.php");
require("../app/errorResponseSender.php");
require("../app/inputValidator.php");
require("../app/passwordEncryptor.php");
require("../app/userAccessChecker.php");


$responseObject = new stdClass();
$responseObject->status = "failed";


if (!isset($_POST["signInData"]) || $_POST["signInData"] == "") {
    $responseObject->error = "Invalid Parameter";
    ErrorSender::sendError($responseObject);
}


$requestData = $_POST["signInData"];
$requestDataObject = json_decode($requestData);

$validator = new Validator($requestDataObject);
$errors = $validator->validator();
foreach ($errors as $key => $value) {
    if ($value) {
        $responseObject->error = $value;
        ErrorSender::sendError($responseObject);
    }
}

$email = $requestDataObject->email;
$password = $requestDataObject->password;


$database = new DB();

$userExistChecker = "SELECT * FROM `users` WHERE `email`=?";
$stmt = $database->prepare($userExistChecker, "s", array($email));
$results = $stmt->get_result();
if (!$results->num_rows) {
    $responseObject->error = "Invalid Email";
    ErrorSender::sendError($responseObject);
}
$userDataForEmail = $results->fetch_assoc();

if (!PasswordHashVerifier::isValid($password, $userDataForEmail["salt"], $userDataForEmail["password_hash"])) {
    $responseObject->error = "Invalid password";
    ErrorSender::sendError($responseObject);
}

$_SESSION["fms_user"] = $userDataForEmail;

$responseObject->status = "success";
ErrorSender::sendError($responseObject);
