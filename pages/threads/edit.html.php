<?php
  require('../../database/threads/edit.php');
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Foro - Unisur</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="../../img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/custom.css">

    <script src="https://kit.fontawesome.com/48b6b080d5.js" crossorigin="anonymous"></script>
    <script src="../../js/jquery-3.6.0.min.js"></script>
</head>

<body class="container">
<header class="header">
    <a href="../../index.html.php" class="header__logo">UNISUR</a>

    <nav class="menu">
        <a href="#">Inicio</a>
        <a href="../../pages/sessions/login.html.php">Iniciar Sesión</a>
        <a href="../../pages/sessions/register.html.php">Registrarse</a>
    </nav>
</header>

<section id="new-post" class="content p-15">
    <table class="mt-20">
        <tr>
            <th colspan="2">Hoy 27/09/2021 - 11:33 AM</th>
        </tr>
        <tr>
            <td class="text-center vertical-align-top user-info">
                <img src="../../img/profile-pictures/1/f1456x819-1083485_1253855_5050.jpg"
                     alt=""
                     width="150px"
                     height="150px;"
                     class="mt-10">

                <div class="mt-10">
                    <a href="#">Ethan Rivas</a> <br>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i> <br>
                    Hilos: <strong>5</strong>
                </div>
            </td>
            <td class="vertical-align-top">
                <?php
                echo '<form action="edit.html.php?post_id='.$post->id.'" method="POST">'; ?>
                    <input type="hidden" name="_method" value="PUT" />
                
                    <div>
                        <label for="title">Título</label>
                      
                        <?php
                            echo  '<input id="title" name="title" type="text" class="full-width" value="'.htmlspecialchars($post->title).'">';
                        ?>
                    </div>

                    <div class="mt-10">
                        <label for="content">Contenido</label>
                          <?php
                            echo '<textarea name="content" id="content" cols="30" rows="10" class="full-width">'.htmlspecialchars($post->content).'</textarea>';
                          ?>
                    </div>

                    <div class="mt-10">
                        <button id="edit-comment" type="submit" name="submit" class="btn btn-success">Editar</button>
                        <?php
                            echo '<a href="../../pages/threads/show.html.php?post_id='.$post->id.'">
                                    <button id="cancel-comment" type="button" class="btn btn-success">Cancelar</button>
                                  </a>';
                        ?>
                    </div>
                </form>
            </td>
        </tr>
    </table>
</section>

<script src="../../js/vendor/modernizr-3.11.2.min.js"></script>
<script src="../../js/plugins.js"></script>
<script src="../../js/main.js"></script>
</body>

</html>
