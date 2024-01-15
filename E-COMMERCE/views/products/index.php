<?php

include '../../models/Session.php';

session_start();

$products = Product::fetchAll();
?>

<html>
<head>
    <title>Catalogo Prodotti</title>
</head>

<body>

<?php foreach ($products as $product) { ?>
    <ul>
        <li><?php echo $product->getMarca() ?></li>
        <li><?php echo $product->getNome() ?></li>
        <li><?php echo $product->getPrezzo() ?></li>
    </ul>

    <form action="../../actions/add_to_cart.php" method="POST">
        <input type="number" name="quantita" placeholder="quantita">
        <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
        <input type="submit" value="submit" >
    </form>


<?php } ?>

<?php include '../navbar.php'; ?>

<a href="../carts/index.php">Vai al carrello</a>


</body>

</html>
