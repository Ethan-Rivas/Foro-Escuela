<?php
  include('../../database/sessions/register.php');
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Foro - Unisur</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">

    <script src="https://kit.fontawesome.com/48b6b080d5.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/custom.css">
</head>

<body class="sessions-container">
    <section class="content register-area">
        <div class="center">
            <div class="session-icon text-center">
                <a href="/"><i class="fas fa-user"></i></a>
            </div>
            <h1>Registrarse</h1>
            <form action="register.html.php" method="POST">
                <div>
                    <label for="email">Correo Electrónico</label>
                    <input id="email" name="email" type="email" class="full-width">
                </div>

                <div class="mt-10">
                    <label for="password">Contraseña</label>
                    <input id="password" name="password" type="password" class="full-width">
                </div>

                <div class="mt-10">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="full-width">
                </div>

                <div class="mt-10">
                    <?php
                        if($errors) {
                            echo '<ul>';
                            foreach($errors as $error) {
                                echo '<li>'.$error.'</li>';
                            }
                            echo '</ul>';
                        }
                    ?>
                </div>

                <div class="options mt-10">
                    <div class="submit">
                        <button class="btn btn-block btn-success" name="submit" type="submit">Registrarse</button>
                    </div>
                    <div class="register mt-10">
                        <a href="./login.html.php">Ya tengo una cuenta</a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="/js/plugins.js"></script>
    <script src="/js/jquery-3.6.0.min.js"></script>

    <script>
        $('#email').focus();
    </script>
</body>

</html>
