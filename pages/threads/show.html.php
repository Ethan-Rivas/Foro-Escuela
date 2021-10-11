<?php
  require('../../database/threads/show.php');
?>

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
      include('../../components/navmenu.html.php');
    ?>
    
    <section class="content p-15">
        <div id="edit-thread" class="mt-20 text-right">
            <?php
                if (isset($_SESSION['user']) && $post->user_email === $_SESSION['user']['email']) {
                    echo '<a href="/pages/threads/edit.html.php?post_id=' . $post->id . '">
                                <button class="btn btn-success">Editar Hilo</button>
                          </a>
                          
                          <a href="/pages/subcategories/index.html.php" onclick="return confirm("Seguro que desea eliminar este hilo?");">
                                <button class="btn btn-success">Eliminar Hilo</button>
                          </a>';
                }
            ?>
        </div>

        <section id="post">
            <table class="mt-20">
                <tr>
                    <th colspan="2">
                        <?php
                            if ($post->created_at > $post->updated_at) {
                                echo 'Creado: '.$post->created_at;
                            } else {
                                echo 'Creado: '.$post->created_at . " - Última edición: " . $post->updated_at;
                            }
                        ?>
                    </th>
                </tr>
                <tr>
                    <td class="text-center vertical-align-top user-info">
                        <?php
                            if ($post->user_image) {
                                echo '<div id="profileImagePreview" style="background-image: url('.$post->user_image.');"></div>';
                            } else {
                                echo '<div id="profileImagePreview"
                                style="background-image: url(https://ui-avatars.com/api/?name='.urlencode($post->user_nickname ? $post->user_nickname : $post->user_email).'&color=FFFFFF&background=a5d6a7);"></div>';
                            }
                        ?>
    
                        <div class="mt-10">
                            <?php
                                echo '<a href="/pages/profile/profile.html.php?user_id=' .$post->user_id. '">'. ($post->user_nickname ? $post->user_nickname : $post->user_email). '</a> <br>'
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i> <br>
                            Hilos:
                            <?php
                                echo '<strong>'.$post->user_threads.'</strong>';
                            ?>
                        </div>
                    </td>
                    <td class="vertical-align-top">
                        <h1 class="text-left">
                            <?php echo htmlspecialchars($post->title) ?>
                        </h1>
    
                        <pre><?php echo htmlspecialchars($post->content) ?></pre>
                    </td>
                </tr>
            </table>
        </section>
        
        <?php
            if (isset($_SESSION['user'])) {
                echo '<div id="create-comment" class="text-center mt-20">
                        <button class="btn btn-success">Nuevo Comentario</button>
                      </div>';
            }
        ?>
    
        <section id="comments">
            <table class="mt-20">
                <tr id="new-comment">
                    <td class="text-center vertical-align-top user-info">
                        <div class="avatar-preview mt-10">
                            <?php
                                require('../../database/threads/comments/new.php');
                                
                                if ($user->image) {
                                    echo '<div id="profileImagePreview" style="background-image: url('.$user->image.');"></div>';
                                } else {
                                    echo '<div id="profileImagePreview" style="background-image: url(https://ui-avatars.com/api/?name='.urlencode($user->nickname ? $user->nickname : $user->email).'&color=FFFFFF&background=a5d6a7);"></div>';
                                }
                            ?>
                        </div>
    
                        <div class="mt-10">
                            <?php
                                echo '<a href="/pages/profile/profile.html.php?user_id=' .$user->id. '">'. ($user->nickname ? $user->nickname : $user->email). '</a> <br>';
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i> <br>
                            Hilos:
                            <?php
                                echo '<strong>'.$user->threads.'</strong>';
                            ?>
                        </div>
                    </td>
                    <td class="vertical-align-top">
                        <?php
                            echo '<form action="show.html.php?post_id='.$_GET["post_id"].'" method="POST">'; ?>
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
                                <button id="publish-comment" type="submit" name="submit" class="btn btn-success">Publicar</button>
                                <button id="cancel-comment" type="reset" class="btn btn-success">Cancelar</button>
    
                                <span class="float-right">Hoy 27/09/2021 - 11:33 AM</span>
                            </div>
                        </form>
                    </td>
                </tr>
    
                <tr>
                    <th colspan="2">Comentarios</th>
                </tr>
	
                <?php
                    require('../../database/threads/comments/index.php');
                ?>
            </table>
        </section>
    </section>
    
    <script src="/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="/js/plugins.js"></script>
    <script src="/js/main.js"></script></script>
</body>

</html>
