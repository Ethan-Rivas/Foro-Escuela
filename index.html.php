<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Foro - Unisur</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/custom.css">

    <script src="https://kit.fontawesome.com/48b6b080d5.js" crossorigin="anonymous"></script>
</head>

<body class="container">
    <?php
      require('components/navmenu.html.php');
    ?>

    <section class="content p-15">
        <table class="mt-20">
            <?php
                require('database/categories/index.php');
            ?>
        </table>
    </section>

    <script src="js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="js/plugins.js"></script>
</body>

</html>

