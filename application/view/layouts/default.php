<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset = "UTF-8">
        <!-- CSS подставляется из массива в контроллере -->
        <link rel = "stylesheet" href = "public\styles\<?php echo $vars['css'];?>.css">
    </head>
    <body>
        <?php echo $content; ?>
    </body>
</html>