<?php

require_once '../models/User.php';

$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password-confirmation'];


if (strcmp($password, $password_confirmation) != 0) {
    header('Location:http://localhost/E-COMMERCE/views/signup.php');
    exit;
}

$pdo = DbManager::Connect("ecommerce");

$stmt = $pdo->prepare("select id from ecommerce.users where email=:email limit 1");
$stmt->bindParam(":email", $email);
$stmt->execute();

$user = $stmt->fetchObject("user");

if (!$user) {
    $stmt = $pdo->prepare("insert into ecommerce.users (email,password) values(:email,:password)");
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);

    if ($stmt->execute()) {
        header('Location:http://localhost/E-COMMERCE/views/login.php');
        exit();
    } else {
        header('Location:http://localhost/E-COMMERCE/views/signup.php');
        exit();
    }

} else {
    header('Location:http://localhost/E-COMMERCE/views/signup.php');
    exit();

}


?>

