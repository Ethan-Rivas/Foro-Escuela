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
    
        // Área de Borrado
        if (isset($_GET["post_id"])) {
            $query = "SELECT id, user_id, post_id FROM posts WHERE posts.id=" . $_GET["post_id"];
            $results = mysqli_query($conn, $query);
            
            if (mysqli_num_rows($results) == 1) {
                $post = (object) $results->fetch_assoc();
                $post_id = $post->post_id ? $post->post_id : $post->id;
                
                if ($_SESSION["user"]["id"] === $post->user_id) {
                    $query = "DELETE FROM posts WHERE id=" . $post->id;
                    $results = mysqli_query($conn, $query);
                    $conn->close();
                    
                    header("location: /pages/threads/show.html.php?post_id=" . $post_id);
                } else {
                    $conn->close();
                    header("location: /pages/threads/show.html.php?post_id=" . $post_id);
                }
            } else {
                $conn->close();
                header("location: /404.html");
            }
        } else {
            header("location: /404.html");
        }
    }