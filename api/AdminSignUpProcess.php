<?php
session_start();

$request = $_POST["signUpProcess"];
$requestObject = json_decode($request);


require("../app/dbQuery.php");
require("../app/errorResponseSender.php");
require("../app/inputValidator.php");
require("../app/passwordEncryptor.php");

$email = $requestObject->email;
$password = $requestObject->password;
$rePassword = $requestObject->rePassword;

$validator = new Validator($requestObject);
$validation = $validator->validator();

$responseObject = new stdClass();

$responseObject->status = "failed";

foreach ($validation as $key => $value) {
    if ($value) {
        $responseObject->error = $value;
        ErrorSender::sendError($responseObject);
    }
}


$v_code = uniqid();

date_default_timezone_set('Asia/Colombo');
$dateTime = new DateTime();
$DateTime = $dateTime->format('Y-m-d H:i:s');

if ($password != $rePassword) {
    $responseObject->error = "passwords are not matching";
    ErrorSender::sendError($responseObject);
}


$passwordencryptor = new StrongPasswordEncryptor();
$encryptedpw = $passwordencryptor->encryptPassword($password);
$hash = $encryptedpw["hash"];
$salt = $encryptedpw["salt"];

$database = new DB();
$insertQuery = "INSERT INTO `users` (`email`,`password_hash`,`password_salt`,`verification_code`,`registered_date`) VALUES (?,?,?,?,?)";
$statement = $database->prepare($insertQuery, "sssss", array($email, $hash, $salt, $v_code, $DateTime));

$searchQuary="SELECT * FROM `users` WHERE `email`= ?";
$prepared = $database->prepare($searchQuary,'s',array($email));
$data = $prepared->get_result();
$user_data = $data->fetch_assoc();

$_SESSION["Admin"] = $user_data;

$responseObject->status = "success";
ErrorSender::sendError($responseObject);
