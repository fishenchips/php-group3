<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

//products will be the ones stored in the session variable
$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

Template::header("Shopping Cart", "");
?>

<div class="cart-container-cart">
    <?php if (!$products) : ?>
        <h3>Your cart is empty..</h3>
    <?php elseif ($_SESSION["cart"]) : ?>
        <form action="/php-group3/scripts/post-create-order.php" method="POST">
            <?php foreach ($products as $product) : ?>

                <div class="product-container-cart">
                    <input type="hidden" name="id[]" value="<?= $product->id ?>">
                    <img class="checkout-img" src="<?=$product->product_img?>" alt="<?= $product->name ?>">
                    <b> <?= $product->name ?> </b>
                    <p> <?= $product->price ?> kr</p>
                </div>

            <?php endforeach ?>
            <input type="submit" value="Purchase">
        </form>

    <?php endif ?>


</div>
<?php
Template::footer();
