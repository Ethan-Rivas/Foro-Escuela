<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    
    if (isset($_SESSION['user'])) {
        $base_path = substr(__DIR__, 0, strpos(__DIR__, 'database')) . '/database';
        require("{$base_path}/connection_info.php");
        
        // Create connection
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        
        // Verificar la conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $errors = array();
        
        // Obtención del Hilo
        if (isset($_GET['post_id'])) {
            $query = "SELECT
                  posts.*,
                  users.nickname AS user_nickname,
                  users.email AS user_email,
                  users.facebook_url AS user_facebook_url,
                  users.twitter_url AS user_twitter_url,
                  users.image AS user_image,
                  count(threads.id) AS user_threads
                  FROM posts
                  JOIN users
                  LEFT JOIN posts AS threads ON threads.user_id = users.id AND threads.post_id IS NULL
                  WHERE posts.id=" . $_GET['post_id'] . "
                  AND threads.post_id IS NULL
                  AND posts.user_id = users.id
                  GROUP BY posts.id";
            
            $results = mysqli_query($conn, $query);
            $post = (object)$results->fetch_assoc();
            
            if (!$post->id || $post->user_id != $_SESSION['user']['id']) {
                header("location: /404.html");
            }
        }
        
        // Área de Edición
        if (isset($_POST['submit']) && $_GET['post_id']) {
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $content = mysqli_real_escape_string($conn, $_POST['content']);
            
            if (empty($title)) {
                array_push($errors, "Se necesita un título para editar un hilo");
            }
            if (empty($content)) {
                array_push($errors, "Se necesita el contenido para editar un hilo");
            }
    
            if (count($errors) == 0) {
                $post_id = $_GET["post_id"];
                $date = date('Y-m-d h:i:s');
    
                $query = "UPDATE posts SET title='$title', content='$content', updated_at='$date' WHERE id = '$post_id'";
                $results = mysqli_query($conn, $query);
                $conn->close();
    
                if ($post->post_id) {
                    header("location: /pages/threads/show.html.php?post_id=$post->post_id");
                } else {
                    header("location: /pages/threads/show.html.php?post_id=$post_id");
                }
            }
        }
    } else {
        header("location: /404.html");
    }