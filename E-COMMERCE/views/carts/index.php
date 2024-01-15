<?php

require_once "../../models/Cart.php";
require_once "../../models/User.php";
require_once "../../models/Product.php";

session_start();

$current_user = $_SESSION['current_user'];
$carrello = Cart::Find($current_user->GetCart_ID());

?>

<html>

<head>
    <title>Carrello</title>
</head>

<body>

    <?php include '../navbar.php'; ?>

    <ul>
        <li>Marca:
            <?php echo Product::Find($carrello->getProductId())->getMarca(); ?>
        </li>
        <li>Nome:
            <?php echo Product::Find($carrello->getProductId())->getNome(); ?>
        </li>
        <li>Prezzo:
            <?php echo Product::Find($carrello->getProductId())->getPrezzo(); ?>
        </li>
        <li>Quantità:
            <?php echo $carrello->getQuantita(); ?>
        </li>
        <li>Totale:
            <?php echo $carrello->getQuantita() * Product::Find($carrello->getProductId())->getPrezzo(); ?>
        </li>
    </ul>

    <form action="../../actions/edit_cart.php" method="POST">
        <label for="quantita">Quantità:</label>
        <input type="number" name="quantita" id="quantita" value="<?php echo $carrello->getQuantita(); ?>">
        <input type="hidden" name="id" value="<?php echo $carrello->getId(); ?>">
        <input type="submit" value="Aggiorna Quantità">
    </form>

    <p>Totale carrello:
        <?php echo $carrello->getQuantita() * Product::Find($carrello->getProductId())->getPrezzo(); ?>
    </p>

</body>

</html>