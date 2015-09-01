<?php

require_once 'userController.php';
require_once 'emailController.php';
header("Content-Type: application/json", true);
$user = new userControllerClass();
$email = new emailControllerClass();
$user->addNewsletterEmail($_POST['email']);
$email->sendEmail($_POST['email'],"Thank you for signing up with Tixzoo! You will recieve more information from us shortly.");
$success["error"] = "false";
echo json_encode($success["error"]);