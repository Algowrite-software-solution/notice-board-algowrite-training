<?php


require("../app/dbQuery.php");
require("../app/errorResponseSender.php");
require("../app/inputValidator.php");
require("../app/passwordEncryptor.php");
require("../app/userAccessChecker.php");

session_start();


$responseObject = new stdClass();
$responseObject->status = "failed";

if (!isset($_POST["signUpData"]) || $_POST["signUpData"] == "") {
    $responseObject->error = "Invalid Parameter";
    ErrorSender::sendError($responseObject);
}

$requestData = $_POST["signUpData"];
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
$retypedPassword = $requestDataObject->retypedPassword;


$database = new DB();

$userExistChecker = "SELECT * FROM `users` WHERE `email`=?";
$stmt = $database->prepare($userExistChecker, "s", array($email));
$results = $stmt->get_result();
if ($results->num_rows) {
    $responseObject->error = "Email ALready Exists";
    ErrorSender::sendError($responseObject);
}



if ($password !== $retypedPassword) {
    $responseObject->error = "Passwords are not matching";
    ErrorSender::sendError($responseObject);
}


$encryptedPassword =  StrongPasswordEncryptor::encryptPassword($password);
$verification_code = uniqid();

$insertQuery = "INSERT INTO `users` (`email`, `password_hash`, `verification_code`, `salt`) VALUES (?,?,?,?) ";
$stmt = $database->prepare($insertQuery, "ssss", array($email, $encryptedPassword["hash"], $verification_code, $encryptedPassword["salt"]));


$loggedUserSearch = "SELECT * FROM `users` WHERE `email` = ? AND `password_hash`=? AND `salt`=? ";
$stmt = $database->prepare($loggedUserSearch, "sss", array($email, $encryptedPassword["hash"], $encryptedPassword["salt"]));
$results = $stmt->get_result();

$_SESSION['fms_user'] = $results->fetch_assoc();

$responseObject->status = "success";
ErrorSender::sendError($responseObject);
