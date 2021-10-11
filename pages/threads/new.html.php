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
</head>

<body class="container">
    <?php
        require('../../components/navmenu.html.php');
        require('../../database/threads/new.php');
    ?>
    
    <section id="new-post" class="content p-15">
        <table class="mt-20">
            <tr>
                <th colspan="2">Hoy 27/09/2021 - 11:33 AM</th>
            </tr>
            <tr>
                <td class="text-center vertical-align-top user-info">
                    <div class="avatar-preview mt-10">
                        <?php
                            if ($user->image) {
                                echo '<div id="profileImagePreview" style="background-image: url(' . $user->image . ');"></div>';
                            } else {
                                echo '<div id="profileImagePreview" style="background-image: url(https://ui-avatars.com/api/?name=' . urlencode($user->nickname ? $user->nickname : $user->email) . '&color=FFFFFF&background=a5d6a7);"></div>';
                            }
                        ?>
                    </div>
    
                    <div class="mt-10">
                        <a href="#">
                            <?php
                                echo $user->nickname ? $user->nickname : $user->email;
                            ?>
                        </a> <br>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i> <br>
                        Hilos:
                        <?php
                            echo '<strong>' . $user->threads . '</strong>';
                        ?>
                    </div>
                </td>
                <td class="vertical-align-top">
                    <?php
                        echo '<form action="new.html.php?category_id=' . $_GET["category_id"] . '" method="POST">'; ?>
                        <div>
                            <label for="title">Título</label>
                            <input id="title" name="title" type="text" class="full-width">
                        </div>
        
                        <div class="mt-10">
                            <label for="content">Contenido</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="full-width"></textarea>
                        </div>
    
                        <!-- Mostrar errores -->
                        <?php
                            include('../../components/errors.php');
                        ?>
        
                        <div class="mt-10">
                            <?php
                                echo '<button id="publish-comment" type="submit" name="submit" class="btn btn-success">Publicar</button>
                                      <a href="/pages/subcategories/index.html.php?category_id='.$_GET["category_id"].'">
                                            <button id="cancel-comment" type="button" class="btn btn-success">Cancelar</button>
                                      </a>';
                            ?>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </section>
    
    <script src="/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="/js/plugins.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/jquery-3.6.0.min.js"></script>

    <script>
        $('#title').focus();
    </script>
</body>

</html>
