<?php

require_once "../models/Cart.php";
require_once "../models/Product.php";

session_start();

$quantita = $_POST['quantita'];
$carrello = Cart::Find($_POST['id']);

$user = $_SESSION['current_user'];



if ($quantita > 0) {
    $carrello->setQuantita($quantita);
    $carrello->save();
} else {
    $carrello->delete();
}

header('Location: http://localhost:8000/views/carts/index.php');
exit;