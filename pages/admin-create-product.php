<?php

require_once __DIR__ . "/../classes/Template.php";

$is_logged_in = isset($_SESSION["user"]);

$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401); //unauthorized
    die("Access denied");
}

Template::header("Create Product", "");

Template::admin_header();
?>

<form action="/php-group3/admin-scripts/admin-post-product.php" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name"> <br>
    <textarea name="description" placeholder="Description"></textarea> <br>
    <input type="number" name="price" placeholder="Price"> <br>
    <input type="file" name="product-img" accept="image/*"> <br>
    <input type="submit" value="Save">
</form>

<?php

Template::footer();
