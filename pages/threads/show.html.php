<?php
  require('../../database/threads/show.php');
	require('../../database/threads/comments/new.php');
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
    <?php
      require('../../components/navmenu.html.php');
    ?>
    
    <section class="content p-15">
        <div id="edit-thread" class="mt-20 text-right">
            <?php
                echo '<a href="../../pages/threads/edit.html.php?post_id='.$post->id.'">
                        <button class="btn btn-success">Editar Hilo</button>
                      </a>';
            ?>
            
    
            <a href="../../pages/subcategories/index.html.php" onclick="return confirm('Seguro que desea eliminar este hilo?');">
                <button class="btn btn-success">Eliminar Hilo</button>
            </a>
        </div>

        <section id="post">
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
                            <a href="../../pages/profile/profile.html.php">Ethan Rivas</a> <br>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i> <br>
                            Hilos: <strong>5</strong>
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
    
        <div id="create-comment" class="text-center mt-20">
            <button class="btn btn-success">Nuevo Comentario</button>
        </div>
    
        <section id="comments">
            <table class="mt-20">
                <tr id="new-comment">
                    <td class="text-center vertical-align-top user-info">
                        <img src="../../img/profile-pictures/1/f1456x819-1083485_1253855_5050.jpg"
                             alt=""
                             width="150px"
                             height="150px;"
                             class="mt-10">
    
                        <div class="mt-10">
                            <a href="../../pages/profile/profile.html.php">Ethan Rivas</a> <br>
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
                            echo '<form action="show.html.php?post_id='.$_GET["post_id"].'" method="POST">'; ?>
                            <div>
                                <label for="title">Título</label>
                                <input id="title" name="title" type="text" class="full-width">
                            </div>
    
                            <div class="mt-10">
                                <label for="content">Contenido</label>
                                <textarea name="content" id="content" cols="30" rows="10" class="full-width"></textarea>
                            </div>

                            <div class="mt-10">
			                        <?php
				                        if($errors) {
					                        echo '<ul>';
					                        foreach($errors as $error) {
						                        echo '<li>'.$error.'</li>';
					                        }
				                        }
			                        ?>
                            </div>
    
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
    
    <script src="../../js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="../../js/plugins.js"></script>
    <script src="../../js/main.js"></script>
</body>

</html>
