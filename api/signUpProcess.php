<?php 
session_start();
// Handle the request accordingly

$user_details = $_POST["signUpData"];
$user_details_object = json_decode($user_details);

// Get the inputs

$email = $user_details_object->email;
$password = $user_details_object->password;
$retypepassword = $user_details_object->retypepassword;


// Validate inputs

require('../app/errorResponseSender.php');

$response_object = new stdClass();

$response_object->status="failed";

require("../app/inputValidator.php");
$validator = new Validator($user_details_object);
$errors =$validator->validator();
foreach ($errors as $key => $value) {
    if ($value){

      $response_object->error=$value;
      ErrorSender::sendError($response_object);

    }
}

if($password!=$retypepassword){
    echo("passwords are not matching");
    die();
}

// Encrypt the password

require("../app/passwordEncryptor.php");
$passwordencryptor = new StrongPasswordEncryptor();
$encryptedpw = $passwordencryptor->encryptPassword($password);
$hash = $encryptedpw["hash"];
$salt = $encryptedpw["salt"];


$verification_code = uniqid();

date_default_timezone_set('Asia/Colombo'); // Set the timezone to Sri Lanka

$currentDateTime = date('Y-m-d H:i:s'); // Get the current date and time in the specified format


// Insert data into the database

require('../app/dbQuery.php');


$database = new DB();
$insertquery = "INSERT INTO `users` (`email`,`password_hash`,`password_salt`,`verification_code`,`registered_date`) VALUES 
(?,?,?,?,?)";
$prepared = $database->prepare($insertquery,'sssss',array($email,$hash,$salt,$verification_code,$currentDateTime));

$rs="SELECT * FROM `users` WHERE `email`= ?";
$prepared2 = $database->prepare($rs,'s',array($email));
$data = $prepared2->get_result();
$user_data = $data->fetch_assoc();

$_SESSION["nb_user"] = $user_data;

$response_object->status="success";
ErrorSender::sendError($response_object);
