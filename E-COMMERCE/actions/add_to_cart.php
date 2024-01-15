<?php

require_once "../models/Cart.php";
require_once "../models/Product.php";

session_start();

$product = Product::Find($_POST['id']);

$user = $_POST['current_user'];

$carrello = Cart::Find_by_product($_POST['id']);

if (!$carrello)
{
    Cart::add($user->getId(), $product->getId(), $_POST['quantita']);
} else
{
    $carrello->setQuantita($carrello->getQuantita() + $_POST['quantita']);
    $carrello->save();
}

?>