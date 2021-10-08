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
<?php
    require('../../components/navmenu.html.php');
    require('../../database/profile/profile.php');
?>

<section class="content p-15">
    <section id="post">
        <table class="mt-20">
            <tr>
                <th colspan="2">Perfil</th>
            </tr>
            <tr class="no-border">
                <td class="text-center vertical-align-top user-info">
                    <div class="avatar-preview mt-10">
                        <?php
                            if ($user->image) {
                                echo '<div id="profileImagePreview" style="background-image: url('.$user->image.');"></div>';
                            } else {
                                echo '<div id="profileImagePreview" style="background-image: url(https://ui-avatars.com/api/?name='.urlencode($user->nickname ? $user->nickname : $user->email).'&color=FFFFFF&background=a5d6a7);"></div>';
                            }
                        ?>
                    </div>

                    <div class="mt-10">
                        <?php
                            echo '<a href="/pages/profile/profile.html.php?user_id=' .$user->id. '">'. ($user->nickname ? $user->nickname : $user->email). '</a> <br>'
                        ?>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i> <br>

                        <div class="mt-10">
                            <?php
                                echo '<a href="mailto:' . $user->email . '">
                                            <i class="fas fa-envelope"></i>
                                          </a>';
                                
                                if ($user->facebook_url) {
                                    echo '<a href="' . $user->facebook_url . '">
                                            <i class="fab fa-facebook-square"></i>
                                          </a>';
                                }
                                
                                if ($user->twitter_url) {
                                    echo '<a href="' . $user->twitter_url . '">
                                            <i class="fab fa-twitter-square"></i>
                                          </a>';
                                }
                            ?>
                        </div>

                        <div class="mt-10">
                            <?php
                                if (isset($_SESSION['user']) && $user->email === $_SESSION['user']['email']) {
                                    echo '<a href="/pages/profile/edit.html.php">
                                          <button class="btn btn-success">Editar</button>
                                      </a>
                                      
                                      <a href="/database/profile/delete.php?user_id='.$_SESSION['user']['id'].'" onclick="return confirm(\'Seguro que desea eliminar su cuenta? (No podrá recuperarla).\');">
                                          <button class="btn btn-success">Eliminar</button>
                                      </a>';
                                }
                            ?>
                        </div>
                    </div>
                </td>
                <td class="vertical-align-top">
                    <section class="vertical-align-top">
                        <table style="margin-top: 10px !important;">
                            <tr>
                                <th colspan="2">Últimos hilos</th>
                                <th class=""><i class="fas fa-clock"></i></th>
                            </tr>
                            
                            <?php
                                if ($threads->num_rows > 0) {
                                    // output data of each row
                                    while ($thread = $threads->fetch_assoc()) {
                                        $content = strlen($thread['content']) >= 100 ? htmlspecialchars(substr($thread['content'], 0, 150)) . '...' . '<a href="../threads/show.html.php?post_id=' . $thread["id"] . '">Ver más</a>' : $thread['content'];
                                        
                                        echo '<tr>
                                                <td class="text-center comment-icon">
                                                    <i class="fas fa-comments forum-icon"></i>
                                                </td>
                                                <td>
                                                    <a href="../threads/show.html.php?post_id=' . $thread["id"] . '">' . $thread["title"] . '</a>
                                                    <p>' . $content . '</p>
                                                </td>
                                                <td class="comments-info">
                                                    <p>'.$thread["created_at"].'</p>
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    echo '<tr>
                                              <td colspan="5" class="text-center">
                                                  No hay hilos disponibles
                                              </td>
                                          </tr>';
                                }
                            ?>
                        </table>
                    </section>

                    <section>
                        <table style="margin-top: 0">
                            <tr>
                                <th colspan="2">Últimos comentarios</th>
                                <th class=""><i class="fas fa-clock"></i></th>
                            </tr>
                            <?php
                                if ($comments->num_rows > 0) {
                                    // output data of each row
                                    while ($comment = $comments->fetch_assoc()) {
                                        $content = strlen($comment['content']) >= 100 ? htmlspecialchars(substr($comment['content'], 0, 150)) . '...' . '<a href="../threads/show.html.php?post_id=' . $comment["id"] . '">Ver más</a>' : $comment['content'];
                
                                        echo '<tr id=' . $comment["id"] .'>
                                                <td class="text-center comment-icon">
                                                    <i class="fas fa-comments forum-icon"></i>
                                                </td>
                                                <td>
                                                    <a href="../threads/show.html.php?post_id=' . $comment["post_id"] .'">' . $comment["title"] . '</a>
                                                    <p>' . $content . '</p>
                                                </td>
                                                <td class="comments-info">
                                                    <p>'.$comment["created_at"].'</p>
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    echo '<tr>
                                              <td colspan="5" class="text-center">
                                                  No hay comentarios disponibles
                                              </td>
                                          </tr>';
                                }
                            ?>
                        </table>
                    </section>
                </td>
            </tr>
        </table>
    </section>
</section>

<script src="../../js/vendor/modernizr-3.11.2.min.js"></script>
<script src="../../js/plugins.js"></script>
</body>

</html>
