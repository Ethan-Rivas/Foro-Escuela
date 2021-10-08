<?php
    
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
        $post_id = $_GET['post_id'];
        $query = "SELECT posts.*,
                  users.nickname AS user_nickname,
                  users.email AS user_email,
                  users.facebook_url AS user_facebook_url,
                  users.twitter_url AS user_twitter_url,
                  users.image AS user_image,
                  count(threads.id) AS user_threads
                  FROM posts
                  LEFT JOIN users ON posts.user_id = users.id
                  LEFT JOIN posts AS threads ON threads.post_id IS NULL AND threads.user_id = users.id
                  WHERE posts.id=" . $_GET["post_id"];
        
        $results = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($results) == 1) {
            $post = (object)$results->fetch_assoc();
            $conn->close();
            
            if ($post->post_id) {
                header("location: /404.html");
            }
        } else {
            $conn->close();
            header("location: /404.html");
        }
    } else {
        $conn->close();
        header("location: /404.html");
    }
