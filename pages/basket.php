<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

//products will be the ones stored in the session variable
$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

Template::header("Shopping Cart", "");
?>

<div class="cart-container">
    <?php if ($_SESSION["cart"] == []) : ?>
        <h3>Your cart is empty..</h3>
    <?php endif ?>
    <?php foreach ($products as $product) : ?>

        <div class="product-container">
            <b> <?= $product->name ?> </b>
            <p> <?= $product->price ?> kr</p>
        </div>

    <?php endforeach ?>
</div>
<?php
Template::footer();
