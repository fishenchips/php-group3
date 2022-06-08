<?php

class Template
{

    /* TEMPLATE HEADER */
    public static function header($topic, $file)
    { ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $topic ?> - siteName</title>
            <link rel="stylesheet" href="/php-group3/assets/style.css">
            <!-- for example "products.css" below -->
            <link rel="stylesheet" href="/php-group3/assets/<?= $file ?>">
        </head>

        <body>
            <h1><?= $topic ?></h1>
        <?php
    }



    /* TEMPLATE FOOTER */
    public static function footer()
    { ?>
            <footer>
                Copyright Philip 2018
            </footer>
        </body>

        </html>
<?php }
}
