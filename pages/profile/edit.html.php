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
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/profile-image-update.js"></script>
</head>

<body class="container">
    <?php
        require('../../components/navmenu.html.php');
        require('../../database/profile/edit.php');
    ?>

    <section id="update-user" class="content p-15">
        <form id="update-info" action="edit.html.php" method="POST" class="center-form" enctype="multipart/form-data">
            <h2>Información</h2>
    
            <div class="profile-image mt-10">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type="file" id="imageUpload" name="image" accept=".png, .jpg, .jpeg, .gif" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <?php
                            if ($user->image) {
                                echo '<div id="imagePreview" style="background-image: url('.$user->image.');" width="150px" height="150px;"></div>';
                            } else {
                                echo '<div id="imagePreview"
                                style="background-image: url(https://ui-avatars.com/api/?name='.urlencode($user->nickname ? $user->nickname : $user->email).'&color=FFFFFF&background=a5d6a7);" width="150px" height="150px;"></div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
    
            <div class="mt-10">
                <label for="title">Usuario</label>
                <?php
                    echo '<input id="nickname" value="'.$user->nickname.'" type="text" name="nickname" class="full-width">';
                ?>
            </div>
    
            <div class="mt-10">
                <label for="content">Descripción</label>
                <?php
                    echo '<textarea name="description" id="description" cols="30" rows="10" class="full-width">'.$user->description.'</textarea>';
                ?>
            </div>
    
            <div class="mt-10">
                <label for="birthday">Fecha de Nacimiento</label>
                <?php
                    $date = new DateTime($user->birthday);
                    $date = $date->format('Y-m-d');
                    
                    echo '<input id="birthday" name="birthday" value="'.$date.'" type="date" class="full-width">';
                ?>
            </div>
    
            <hr>
    
            <h2>Social</h2>
    
            <div class="mt-10">
                <label for="email">Correo Electrónico</label>
                <?php
                    echo '<input id="email" name="email" value="'.$user->email.'" type="text" class="full-width">';
                ?>
            </div>
    
            <div class="mt-10">
                <label for="fb">Facebook</label>
                <?php
                    echo ' <input id="fb" name="facebook_url" value="'.$user->facebook_url.'" type="text" class="full-width">';
                ?>
            </div>
    
            <div class="mt-10">
                <label for="twt">Twitter</label>
                <?php
                    echo ' <input id="twt" name="twitter_url" value="'.$user->twitter_url.'" type="text" class="full-width">';
                ?>
            </div>
    
            <hr>
    
            <h2>Seguridad</h2>
    
            <div class="mt-10">
                <label for="password">Contraseña</label>
                <input id="password" name="password" type="password" class="full-width">
            </div>

            <div class="mt-10">
                <label for="password">Nueva Contraseña</label>
                <input id="new_password" name="new_password" type="password" class="full-width">
            </div>
    
            <div class="mt-10">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="full-width">
            </div>

            <<!-- Mostrar errores -->
            <?php
                include('../../components/errors.php');
            ?>
    
            <div class="mt-20 text-center">
                <?php
                    echo '<button id="edit-comment" type="submit" name="submit" class="btn btn-success">Editar</button>
                           <a href="/pages/profile/profile.html.php?user_id='.$_SESSION["user"]["id"].'">
                                <button id="cancel-comment" type="button" class="btn btn-success">Cancelar</button>
                           </a>';
                ?>
                
            </div>
        </form>
    </section>
    
    <script src="/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="/js/plugins.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>
