<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Foro - Unisur</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/custom.css">

    <script src="https://kit.fontawesome.com/48b6b080d5.js" crossorigin="anonymous"></script>
</head>

<body class="container">
    <?php
      require('../../components/navmenu.html.php');
    ?>
    
    <section class="content p-15">
        <div id="create-thread" class="mt-20 text-right">
          <?php
              if (isset($_SESSION['user'])) {
                  echo '<a href="/pages/threads/new.html.php?category_id='.$_GET["category_id"].'">
                    <button class="btn btn-success">Nuevo Hilo</button>
                 </a>';
              }
          ?>
        </div>
    
        <table style="margin-top: 15px !important;">
            <tr>
                <th colspan="2">Hilos</th>
                <th class="text-center"><i class="fas fa-comment-dots"></i></th>
                <th class=""><i class="fas fa-clock"></i></th>
            </tr>
    
            <?php
                require('../../database/threads/index.php');
            ?>
        </table>
    </section>
    
    <script src="/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="/js/plugins.js"></script>
</body>

</html>
