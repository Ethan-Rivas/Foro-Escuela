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
                            if ($post->user_image) {
                                echo '<div id="profileImagePreview" style="background-image: url('.$post->user_image.');"></div>';
                            } else {
                                echo '<div id="profileImagePreview"
                                style="background-image: url(https://ui-avatars.com/api/?name='.urlencode($post->user_nickname ? $post->user_nickname : $post->user_email).'&color=FFFFFF&background=a5d6a7);"></div>';
                            }
                        ?>
                    </div>
    
                    <div class="mt-10">
                        <a href="#">
                            <?php
                                echo $post->user_nickname ? $post->user_nickname : $post->user_email;
                            ?>
                        </a> <br>
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
                    <?php
                        echo '<form action="edit.html.php?post_id='.$post->id.'" method="POST">';
                    ?>
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

                        <!-- Mostrar errores -->
                        <?php
                            include('../../components/errors.php');
                        ?>
    
                        <div class="mt-10">
                            <button id="edit-comment" type="submit" name="submit" class="btn btn-success">Editar</button>
                            
                            <?php
                                if($post->post_id) {
                                    echo '<a href="../../pages/threads/show.html.php?post_id=' . $post->post_id . '">
                                            <button id="cancel-comment" type="button" class="btn btn-success">Cancelar</button>
                                          </a>';
                                } else {
                                    echo '<a href="../../pages/threads/show.html.php?post_id=' . $post->id . '">
                                            <button id="cancel-comment" type="button" class="btn btn-success">Cancelar</button>
                                          </a>';
                                }
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
</body>

</html>
