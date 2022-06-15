<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$users_db = new UsersDatabase();

$users = $users_db->get_all();

?>

<h2>Users</h2>

<?php foreach ($users as $user) : ?>

    <p>
        <a href="/php-group3/pages/admin-edit-user.php?username=<?= $user->username ?>"><?= $user->username ?></a>
        <i><?= $user->role ?></i>


    </p>

    <form action="/php-group3/admin-scripts/admin-post-delete-user.php" method="post">
        <input type="hidden" name="id" value="<?= $user->id?>">
        <input type="submit" value="Delete user">
    </form>

<?php endforeach; ?>